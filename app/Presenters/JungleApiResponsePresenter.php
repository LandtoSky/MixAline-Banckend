<?php

namespace App\Presenters;

use App\Http\Resources\WikipediaResource;
use Carbon\Carbon;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class JungleApiResponsePresenter
{
    /**
     * @var WikipediaResource
     */
    private $resource;

    /**
     * JungleApiResponsePresenter constructor.
     *
     * @param \App\Http\Resources\WikipediaResource $resource
     */
    public function __construct(WikipediaResource $resource)
    {
        $this->resource = $resource;
    }

    /**
     * @param string $markup
     * @return string
     */
    private function sanitizeWikiAttributes($markup) {
        $combinations = [
            "\\r\\n",
            "\\r",
            "\\n",
            "\\t",
            "\r\n",
            "\r",
            "\n",
            "\t",
            "c. "
        ];

        $prepared = preg_replace("/\[wiki=([\w\d]+)\](.*?)\[\/wiki\]/i", "$2", $markup);
        $prepared = str_replace($combinations, '', $prepared);

        $prepared = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
            return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UTF-16BE');
        }, $prepared);

        return $prepared;
    }

    /**
     * @param string[] $sections
     * @return string[]
     */
    private function prepareSections($sections) {
        $preparedSections = [];

        foreach($sections as $section) {
            /**
             * Remove response artifacts
             */
            if(strpos($section["text"], "text/x-wiki") >= 0) {
                $needle = "\"*\":\"";

                $section["text"] = substr(
                    $section["text"],
                    (strpos($section["text"], $needle) + strlen($needle)),
                    strlen($section["text"])
                );
            }

            array_push($preparedSections, [
                "markup" => $section["text"],
                "text" => $this->sanitizeWikiAttributes($section["text"])
            ]);
        }

        return $preparedSections;
    }

    public function present($map) {
        if(empty($map)) {
            throw new InvalidArgumentException("Wikipedia data presenter expects given data to be a valid jungle map");
        }

        $page = $map["page_attributes"];

        switch($page['type']) {
            default:
            case "main":

                $result = [
                    "image" => null,
                    "title" => $map["title"]
                ];

                if(isset($map["sections"]) && !empty($map["sections"])) {
                    $sections = $this->prepareSections($map["sections"]);
                    $firstSection = array_first($sections);

                    $result["description"] = substr(
                        $firstSection["text"],
                        0,
                        strpos(
                            $firstSection["text"],
                            "."
                        )
                    );

//                    $result["content"] = $sections;
                } else {
                    $result["description"] = null;
                }

                if(isset($map["meta_boxes"]) && !empty($map["meta_boxes"])) {
//                    $result["meta"] = [];

                    foreach($map["meta_boxes"] as $type => $properties) {
//                        $result["meta"]["type"] = $type;

                        foreach($properties as $key => $value) {
                            $sanitized = $this->sanitizeWikiAttributes($value);

                            if(empty($sanitized)) {
                                continue;
                            }

                            switch($key) {
//                                default:
//
//                                    $result["meta"][$key] = $sanitized;
//
//                                    break;

                                case "image":

                                    $imageSrc = $this->resource->transformFileIntoSrc($sanitized);

                                    if(!is_null($imageSrc)) {
                                        $result["image"]["src"] = $imageSrc;
                                    }

                                    break;

                                case "alt":
                                case "caption":

                                    $result["image"][$key] = $sanitized;

                                    break;

                                case "birth_date":
                                case "death_date":

                                    if(is_array($sanitized)) {
                                        $result["age"][$key] = $sanitized[0];
                                        $result["age"]["age"] = $sanitized[1];
                                    } else {
                                        if(preg_match("/(\d+) (BC|AD)/is", $sanitized, $matches)) {
                                            $result["age"][$key] = $sanitized;
                                        } else {
                                            $result["age"][$key] = Carbon::parse($sanitized);
                                        }
                                    }

                                    break;
                            }
                        }
                    }
                }

                if(isset($result["age"]["birth_date"]) && isset($result["age"]["death_date"])) {
                    if($result["age"]["death_date"] instanceof Carbon &&
                        $result["age"]["birth_date"]  instanceof Carbon)
                    {
                        $result["age"]["age"] = $result["age"]["death_date"]->diff($result["age"]["birth_date"])->y;

                        $result["age"]["birth_date"] = (string) $result["age"]["birth_date"];
                        $result["age"]["death_date"] = (string) $result["age"]["death_date"];
                    }
                }

                if(isset($map["wikipedia_meta"]) && !empty($map["wikipedia_meta"])) {
                    foreach($map["wikipedia_meta"] as $type => $meta) {
                        switch($type) {
                            case "attachments":

                                $result["attachments"] = [];

                                foreach($meta as $attachment) {
                                    $src = $this->resource->transformFileIntoSrc($attachment["filename"]);

                                    if(!is_null($src)) {
                                        array_push(
                                            $result["attachments"],
                                            [
                                                "type" => $attachment["type"],
                                                "name" => $attachment["filename"],
                                                "src" => $src
                                            ]
                                        );
                                    }
                                }

                                break;
                        }
                    }
                }

//                if(isset($map["citations"]) && !empty($map["citations"])) {
//                    foreach($map["citations"] as $citation) {
//                        dd([__CLASS__, __LINE__, $citation]);
//
//                        array_push(
//                            $result["citations"],
//                            [
//                                "type" => $citation[":type"],
//                                "text" => $this->resource->transformWikiTextIntoText($citation[":raw"]),
//                                "title" => isset($citation["author"]) ? $citation["author"] : "",
//                                "year" => isset($citation["year"]) ? $citation["year"] : "",
//                            ]
//                        );
//                    }
//                }

                return $result;

            case "redirect":
                return $this->query($page["child_of"]);
        }
    }
}