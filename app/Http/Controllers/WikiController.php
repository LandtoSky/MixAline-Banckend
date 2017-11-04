<?php

namespace App\Http\Controllers;

use App\Http\Resources\WikipediaResource;
use App\Presenters\JungleApiResponsePresenter;
use Casinelli\Wikipedia\QueryBuilder;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller;
use Rise\WikiParser\Jungle_WikiSyntax_Parser;

class WikiController extends Controller
{
    /**
     * @var \App\Http\Resources\WikipediaResource
     */
    private $wikipediaResource;
    /**
     * @var \App\Presenters\JungleApiResponsePresenter
     */
    private $presenter;

    /**
     * WikiController constructor.
     *
     * @param \App\Http\Resources\WikipediaResource      $wikipediaResource
     * @param \App\Presenters\JungleApiResponsePresenter $presenter
     */
    public function __construct(WikipediaResource $wikipediaResource, JungleApiResponsePresenter $presenter)
    {
        $this->wikipediaResource = $wikipediaResource;
        $this->presenter = $presenter;
    }

    public function findByUrl(Request $request) {
        $this->validate($request, [
            'search' => 'required|string',
        ]);

        $searchFor = $request->input("search", "API");

        if(strpos($searchFor, "wikipedia.org") >= 0) {
            $searchFor = array_last(explode("/", $searchFor));
        }

        $result = $this->wikipediaResource->query($searchFor, "en");

        return response()->json([
            "success" => true,
            "result" => $this->presenter->present($result)
        ], 201);
    }

    public function searchByKey(Request $request)
    {
        $openSearch = $request->input('open_search');
        $result = $this->wikipediaResource->search($openSearch, "en");

        return response()->json([
            "success" => true,
            "result" => $result
        ], 201);
    }
}