<?php
// Veux récupérer l'ensemble des données de l'API 
namespace  App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiService
{

    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getData(): array
    {
        $response = $this->client->request(
            'GET',
            'https://valorant-api.com/v1/agents',
        );
        return $response->toArray();
    }

    public function getAgent($id): array
    {
        $response = $this->client->request(
            'GET',
            'https://valorant-api.com/v1/agents/' . $id,
        );
        return $response->toArray();
    }
}
