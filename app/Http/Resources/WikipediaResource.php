<?php

namespace App\Http\Resources;

use App\Http\Resources\Contracts\ResourceContract;
use App\Http\Resources\Exceptions\FailedToQueryWikiData;
use GuzzleHttp\Client;
use Rise\WikiParser\Jungle_WikiSyntax_Parser;

class WikipediaResource implements ResourceContract
{
    const QUERY_URL = "http://%s.wikipedia.org/w/api.php?action=query&prop=revisions&rvlimit=1&rvprop=content&titles=%s&format=json";
    const IMAGE_INFO_URL = "http://%s.wikipedia.org/w/api.php?action=query&prop=imageinfo&iiprop=url&titles=%s&format=json";
    const EXPAND_URL = "http://%s.wikipedia.org/w/api.php?action=expandtemplates&text=%s&contentmodel=wikitext&format=json";
    const SEARCH_URL = "https://%s.wikipedia.org/w/api.php?action=opensearch&search=%s&limit=10&namespace=0&format=json";

    /**
     * @var \GuzzleHttp\Client
     */
    private $httpClient;

    /**
     * WikipediaResource constructor.
     *
     * @param \GuzzleHttp\Client                        $httpClient
     */
    public function __construct(Client $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @param $markup
     * @param $title
     * @return array
     */
    private function parseData($markup, $title) {
        $parser = new Jungle_WikiSyntax_Parser($markup, $title);

        return $parser->parse();
    }

    /**
     * @param string $url
     * @return string
     * @throws \App\Http\Resources\Exceptions\FailedToQueryWikiData
     */
    private function loadUrl($url) {
        $response = $this->httpClient->get($url);

        if($response->withStatus(200)) {
            return $response->getBody()->getContents();
        }

        throw new FailedToQueryWikiData($url, $response);
    }

    public function transformFileIntoSrc($file, $lang = 'en') {
        if(strpos($file, "File:") === false) {
            $file = sprintf("File:%s", $file);
        }

        $queryUrl = sprintf(static::IMAGE_INFO_URL, $lang, urlencode($file));

        $response = $this->httpClient->get($queryUrl);

        if($response->withStatus(200)) {
            $parsedData = $this->parseData(
                $response->getBody()->getContents(),
                $file
            );

            if(!empty($parsedData["sections"])) {
                $section = json_decode($parsedData["sections"][0]["text"], true);
                $result = array_first($section["query"]["pages"]);

                if(!isset($result["imageinfo"]) || empty($result["imageinfo"])) {
                    return null;
                }

                return $result["imageinfo"][0]["url"];
            }
        }

        throw new FailedToQueryWikiData($queryUrl, $response);
    }

    /**
     * @param string $raw
     * @param string $lang
     * @return string
     * @throws \App\Http\Resources\Exceptions\FailedToQueryWikiData
     */
    public function transformWikiTextIntoHtml($raw, $lang = 'en') {
        $queryUrl = sprintf(static::EXPAND_URL, $lang, $raw);

        $response = $this->httpClient->get($queryUrl);

        if($response->withStatus(200)) {
            $content = json_decode($response->getBody()->getContents(), true);
            return $content["parse"]["text"]["*"];
        }

        throw new FailedToQueryWikiData($queryUrl, $response);
    }

    /**
     * @param string $raw
     * @param string $lang
     * @return string
     */
    public function transformWikiTextIntoText($raw, $lang = 'en') {
        return $this->transformWikiTextIntoHtml($raw);
    }

    /**
     * @param        $title
     * @param string $lang
     * @return array
     * @throws \App\Http\Resources\Exceptions\FailedToQueryWikiData
     */
    public function query($title, $lang = "en") {
        $queryUrl = sprintf(static::QUERY_URL, $lang, urlencode($title));
        $content = $this->loadUrl($queryUrl);

        $parsedData = $this->parseData(
            $content,
            $title
        );

        $page = $parsedData["page_attributes"];

        switch($page['type']) {
            default:
            case "main":
                return $parsedData;

            case "redirect":
                return $this->query($page["child_of"]);
        }
    }

    public function search($title, $lang = "en")
    {
        $searchUrl = sprintf(static::SEARCH_URL, $lang, urlencode($title));
        $content = $this->loadUrl($searchUrl);
        return json_decode($content);
    }
}