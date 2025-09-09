<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class TldCategories extends SpatieData
{
    public function __construct(
        public ?array $general = null,
        public ?array $continents = null,
        public ?array $categories = null,
    ) {}
}
