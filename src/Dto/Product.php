<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class Product extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?string $group = null,
        public ?string $name = null,
        public ?string $type = null,
        public ?string $category = null,
        public ?bool $isMainProduct = null,
        public ?bool $promoted = null,
        public ?bool $required = null,
        public ?bool $renew = null,
        public ?int $renewAsProductId = null,
        public ?string $params = null,
        public ?array $crossSales = null,
    ) {}
}
