<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Order extends SpatieData
{
    public function __construct(
        #[MapName('orderID')]
        public ?int $orderId = null,
        public ?string $alias = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $status = null,
        public ?string $dateCreated = null,
        public ?array $items = null,
        public ?object $price = null,
    ) {}
}
