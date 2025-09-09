<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class MaintenanceEntry extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?int $dateStart = null,
        public ?int $dateEnd = null,
        public ?string $timezone = null,
        public ?string $status = null,
        public ?string $type = null,
        public ?string $productType = null,
        public ?string $title = null,
        public ?string $description = null,
        public ?bool $stickyWhenPlanned = null,
        public ?bool $stickyWhenActive = null,
        public ?array $comments = null,
    ) {}
}
