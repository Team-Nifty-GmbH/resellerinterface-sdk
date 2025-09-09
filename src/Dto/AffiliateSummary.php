<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class AffiliateSummary extends SpatieData
{
    public function __construct(
        public ?object $customer = null,
        public ?object $basic = null,
        public ?object $premium = null,
        public ?object $professional = null,
    ) {}
}
