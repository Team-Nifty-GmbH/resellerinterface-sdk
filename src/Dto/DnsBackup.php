<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class DnsBackup extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('domainID')]
        public ?int $domainId = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $type = null,
        public ?string $dateCreated = null,
        public ?object $soa = null,
        public ?object $records = null,
    ) {}
}
