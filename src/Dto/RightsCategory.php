<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class RightsCategory extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?int $resellerId = null,
        public ?string $name = null,
        public ?object $rights = null,
        public ?array $rightsGroups = null,
    ) {}
}
