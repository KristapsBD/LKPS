<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\GoogleMapsService;
use GuzzleHttp\Client;

class GoogleMapsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register()
    {
        $this->app->bind(GoogleMapsService::class, function ($app) {
            $apiKey = config('services.google.maps.api_key');
            $httpClient = new Client(['verify' => false]); // TODO REMOVE FALSE VERIFY ON PRODUCTION

            return new GoogleMapsService($apiKey, $httpClient);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        //
    }
}
