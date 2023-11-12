<?php

namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{
    private $client;

    public function __construct(httpClientInterface $client){
        $this->client = $client ;
    }
    public function getDayData(): array {

        $response = $this->client->request(
            'GET',
            'https://calendrier.api.gouv.fr/jours-feries/metropole/2023.json'

        );
        return $response->toArray();
    }

}