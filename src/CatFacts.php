<?php

declare(strict_types=1);

namespace Rocksheep\CatFacts;

use Rocksheep\CatFacts\Api\Facts;

class CatFacts
{
    private HttpClient $httpClient;

    public function __construct(?HttpClient $httpClient = null)
    {
        $this->httpClient = $httpClient ?: new HttpClient();
    }

    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    public function facts(): Facts
    {
        return new Facts($this);
    }
}
