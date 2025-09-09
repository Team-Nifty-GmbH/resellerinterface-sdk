<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class FlexdnsUser extends SpatieData
{
    public function __construct(
        #[MapName('userID')]
        public ?int $userId = null,
        public ?string $username = null,
        #[MapName('IPv4')]
        public ?string $ipv4 = null,
        #[MapName('IPv6')]
        public ?string $ipv6 = null,
        public ?string $category = null,
        public ?int $dateCreated = null,
        public ?string $dateLastUpdate = null,
    ) {}
}
