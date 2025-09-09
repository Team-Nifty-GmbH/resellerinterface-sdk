<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class ResellerPricelistPromotion extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $name = null,
        #[MapName('pricelistID')]
        public ?int $pricelistId = null,
        public ?string $price = null,
        #[MapName('productID')]
        public ?int $productId = null,
        public ?string $productVariant = null,
        public ?string $validFrom = null,
        public ?string $validTo = null,
    ) {}
}
