<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class DnsSoa extends SpatieData
{
    public function __construct(
        public ?bool $active = null,
        public ?string $primary = null,
        public ?string $mail = null,
        public ?string $serial = null,
        public ?int $refresh = null,
        public ?int $retry = null,
        public ?int $expire = null,
        public ?int $minimum = null,
        public ?int $ttl = null,
    ) {}
}
