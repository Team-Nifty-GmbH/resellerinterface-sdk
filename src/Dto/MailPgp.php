<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Data as SpatieData;

class MailPgp extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        public ?int $resellerId = null,
        public ?string $vendorId = null,
        public ?string $email = null,
        public ?string $publicKey = null,
        public ?bool $alwaysSign = null,
        public ?bool $alwaysEncrypt = null,
        public ?bool $onlyAcceptSigned = null,
        public ?string $dateCreated = null,
        public ?string $dateUpdated = null,
    ) {}
}
