<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Invoice extends SpatieData
{
    public function __construct(
        #[MapName('invoiceID')]
        public ?int $invoiceId = null,
        public ?string $alias = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $status = null,
        public ?string $dateCreated = null,
        public ?string $datePayed = null,
        public ?object $billingAddress = null,
        public ?array $items = null,
        public ?object $relatedBalance = null,
        #[MapName('csvFileID')]
        public ?int $csvFileId = null,
        #[MapName('xmlFileID')]
        public ?int $xmlFileId = null,
        #[MapName('pdfFileID')]
        public ?string $pdfFileId = null,
        public ?string $vat = null,
        public ?object $price = null,
    ) {}
}
