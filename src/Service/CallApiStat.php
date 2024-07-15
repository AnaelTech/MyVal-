<?php
// Veux récupérer l'ensemble des données de l'API 
namespace  App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class CallApiStat
{

    private $client;
    // private $apiKey;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getStat($PseudoValo, $tag): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.henrikdev.xyz/valorant/v1/account/' . $PseudoValo . '/' . $tag,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $_ENV['API_KEY'],
                ],
            ]
        );
        return $response->toArray();
    }

    public function getHistory($id): array
    {
        $response = $this->client->request(
            'GET',
            'https://api.henrikdev.xyz/valorant/v1/by-puuid/lifetime/matches/eu/' . $id,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => $_ENV['API_KEY'],
                ],
            ]
        );
        return $response->toArray();
    }
}
