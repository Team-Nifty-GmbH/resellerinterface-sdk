<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class ResellerPricelist extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $name = null,
        public ?object $resellers = null,
    ) {}
}
