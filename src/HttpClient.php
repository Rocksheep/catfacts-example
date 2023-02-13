<?php

declare(strict_types=1);

namespace Rocksheep\CatFacts;

use Exception;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use JsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

class HttpClient
{
    private ClientInterface $client;
    private RequestFactoryInterface $requestFactory;

    protected string $baseUrl = 'https://cat-fact.herokuapp.com';

    public function __construct(
        ?ClientInterface $client = null,
        ?RequestFactoryInterface $requestFactory = null
    )
    {
        $this->client = $client ?: Psr18ClientDiscovery::find();
        $this->requestFactory = $requestFactory ?: Psr17FactoryDiscovery::findRequestFactory();
    }

    /**
     * @throws JsonException
     * @throws Exception
     */
    public function sendRequest(string $method, string $uri): array
    {
        $request = $this->requestFactory->createRequest($method, sprintf('%s/%s', $this->baseUrl, ltrim($uri, '/')));

        try {
            $response = $this->client->sendRequest($request);
        } catch (ClientExceptionInterface $e) {
            throw new Exception('Oh well');
        }

        if ($response->getStatusCode() >= 400) {
            throw new Exception('Too bad');
        }

        $responseBody = (string) $response->getBody();

        return json_decode($responseBody, false, 512, JSON_THROW_ON_ERROR);
    }
}
