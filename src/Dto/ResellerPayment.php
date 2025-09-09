<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class ResellerPayment extends SpatieData
{
    public function __construct(
        #[MapName('paymentID')]
        public ?int $paymentId = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $reference = null,
        public ?string $amount = null,
        public ?string $status = null,
        public ?string $type = null,
        public ?string $dateCreated = null,
        public ?string $dateValuta = null,
    ) {}
}
