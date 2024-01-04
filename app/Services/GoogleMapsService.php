<?php

namespace App\Services;

use GuzzleHttp\Client;

class GoogleMapsService
{
    /**
     * Google Maps API key.
     *
     * @var string
     */
    protected $apiKey;

    /**
     * Guzzle HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * Create a new GoogleMapsService instance.
     *
     * @param  string  $apiKey  Google Maps API key
     * @param  \GuzzleHttp\Client  $httpClient  Guzzle HTTP client instance
     */
    public function __construct($apiKey, Client $httpClient)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = $httpClient;
    }

    /**
     * Get the optimized route using the Google Maps Directions API.
     *
     * @param  string  $origin  Starting point of the route
     * @param  string  $destination  Destination point of the route
     * @param  array  $waypoints  Array of waypoints for optimization
     * @return array  Decoded JSON response from the API
     */
    public function getOptimizedRoute($origin, $destination, $waypoints)
    {
        $response = $this->httpClient->get('https://maps.googleapis.com/maps/api/directions/json', [
            'query' => [
                'origin'      => $origin,
                'destination' => $destination,
                'waypoints'   => 'optimize:true|' . implode('|', $waypoints),
                'key'         => $this->apiKey,
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}
