<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class RightsGroup extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?int $resellerId = null,
        public ?string $name = null,
        public ?bool $rightsState = null,
        public ?object $rights = null,
    ) {}
}
