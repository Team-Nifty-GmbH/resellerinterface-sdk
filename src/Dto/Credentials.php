<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class Credentials extends SpatieData
{
    public function __construct(
        public ?string $username = null,
        public ?string $password = null,
    ) {}
}
