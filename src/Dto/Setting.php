<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Setting extends SpatieData
{
    public function __construct(
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $group = null,
        public ?string $name = null,
        public ?object $value = null,
        public ?object $configuration = null,
        public ?object $subresellerInheritanceMode = null,
    ) {}
}
