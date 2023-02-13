<?php

declare(strict_types=1);

namespace Rocksheep\CatFacts\Api;

use Rocksheep\CatFacts\CatFacts;
use Rocksheep\CatFacts\Models\Fact;

class Facts
{
    private CatFacts $catFacts;

    public function __construct(CatFacts $catFacts)
    {
        $this->catFacts = $catFacts;
    }

    /**
     * @return array<Fact>
     * @throws \JsonException
     */
    public function all(): array
    {
        $response = $this->catFacts->getHttpClient()->sendRequest('get', 'facts');

        return array_map(
            fn (\stdClass $fact) => new Fact($fact->_id, $fact->text),
            $response
        );
    }
}
