<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleMapsService
{
    protected $apiKey;
    protected $httpClient;

    public function __construct($apiKey, Client $httpClient)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }

    public function getOptimizedRoute($origin, $destination, $waypoints)
    {
        $response = $this->httpClient->get('https://maps.googleapis.com/maps/api/directions/json', [
            'query' => [
                'origin'      => $origin,
                'destination' => $destination,
//                'waypoints' => $waypoints,
                'waypoints'   => 'optimize:true|' . implode('|', $waypoints),
                'key'         => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
