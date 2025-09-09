<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class DnsRecords extends SpatieData
{
    public function __construct(
        #[MapName(15666749)]
        public ?object $property_15666749 = null,
        #[MapName(15666750)]
        public ?object $property_15666750 = null,
        #[MapName(15666751)]
        public ?object $property_15666751 = null,
        #[MapName(15666765)]
        public ?object $property_15666765 = null,
        #[MapName(15666766)]
        public ?object $property_15666766 = null,
    ) {}
}
