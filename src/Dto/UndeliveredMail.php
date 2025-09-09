<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class UndeliveredMail extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?int $resellerId = null,
        public ?string $eMailAddress = null,
        public ?string $undeliveredDate = null,
        public ?string $lastRetryDate = null,
        public ?string $nextRetryDate = null,
    ) {}
}
