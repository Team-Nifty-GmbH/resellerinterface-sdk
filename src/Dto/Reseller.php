<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Reseller extends SpatieData
{
    public function __construct(
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('parentID')]
        public ?int $parentId = null,
        public ?string $state = null,
        public ?string $company = null,
        public ?string $firstname = null,
        public ?string $lastname = null,
        public ?string $addon = null,
        public ?string $street = null,
        public ?string $number = null,
        public ?string $postcode = null,
        public ?string $city = null,
        public ?string $country = null,
        public ?string $mail = null,
        public ?string $phone = null,
        public ?string $fax = null,
        public ?array $parents = null,
        public ?object $settings = null,
    ) {}
}
