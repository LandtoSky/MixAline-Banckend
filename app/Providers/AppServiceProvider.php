<?php

namespace App\Providers;

use Casinelli\Wikipedia\QueryBuilder;
use GuzzleHttp\Client;
use Illuminate\Support\ServiceProvider;
use Rise\WikiParser\Jungle_WikiSyntax_Parser;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->make(Jungle_WikiSyntax_Parser::class);
    }
}
