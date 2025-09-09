<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class TlsCertificate extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('tlsID')]
        public ?int $tlsId = null,
        #[MapName('domainID')]
        public ?string $domainId = null,
        public ?bool $inUse = null,
        public ?bool $autoRenew = null,
        #[MapName('previousCertificateID')]
        public ?int $previousCertificateId = null,
        #[MapName('nextCertificateID')]
        public ?string $nextCertificateId = null,
        public ?string $type = null,
        public ?string $state = null,
        public ?array $san = null,
        public ?string $validFrom = null,
        public ?string $validTill = null,
        public ?string $issuedAt = null,
    ) {}
}
