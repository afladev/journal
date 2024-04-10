<?php

namespace App\Providers;

use FeedIo\FeedIo;
use GuzzleHttp\Client;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class FeedClientHttpServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(FeedIo::class, function (Application $app) {
            return new FeedIo(new \FeedIo\Adapter\Http\Client(new Client()));
        });
    }
}
