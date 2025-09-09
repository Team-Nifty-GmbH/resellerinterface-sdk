<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class DnsRecord extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?string $name = null,
        public ?int $ttl = null,
        public ?string $type = null,
        public ?int $priority = null,
        public ?string $content = null,
    ) {}
}
