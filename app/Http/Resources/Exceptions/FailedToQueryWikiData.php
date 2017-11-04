<?php

namespace App\Http\Resources\Exceptions;

use Exception;
use GuzzleHttp\Psr7\Response;

class FailedToQueryWikiData extends Exception
{
    /**
     * @var \GuzzleHttp\Psr7\Response
     */
    private $response;

    /**
     * FailedToQueryWikiData constructor.
     *
     * @param string                    $url
     * @param \GuzzleHttp\Psr7\Response $response
     */
    public function __construct($url, Response $response)
    {
        $this->response = $response;
        $this->message = sprintf("failed to query %s due to %s", $url, $response->getBody()->getContents());
    }
}