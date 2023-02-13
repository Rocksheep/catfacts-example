<?php

declare(strict_types=1);

namespace Rocksheep\CatFacts\Models;

class Fact
{
    public function __construct(
        public string $id,
        public string $text
    ) {}
}
