<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class HostObjectActive extends SpatieData
{
    public function __construct(
        #[MapName('hostObjectID')]
        public ?int $hostObjectId = null,
        #[MapName('domainID')]
        public ?string $domainId = null,
        public ?string $state = null,
        public ?string $hostname = null,
        #[MapName('ipV4Addresses')]
        public ?array $ipV4addresses = null,
        #[MapName('ipV6Addresses')]
        public ?array $ipV6addresses = null,
    ) {}
}
