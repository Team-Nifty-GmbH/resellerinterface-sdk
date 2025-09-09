<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Tls extends SpatieData
{
    public function __construct(
        #[MapName('tlsID')]
        public ?int $tlsId = null,
        public ?string $alias = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?string $validationState = null,
        public ?string $lastBillingDate = null,
        public ?string $nextBillingDate = null,
        public ?string $lastPaymentDate = null,
        public ?string $nextPaymentDate = null,
        public ?string $createDate = null,
        public ?string $orderDate = null,
        public ?string $deleteDate = null,
        public ?string $cleanupDate = null,
        public ?string $cancellationDate = null,
        public ?string $cancellationInitiatedDate = null,
        public ?bool $cancellationRevokable = null,
        public ?string $tag = null,
        public ?string $comment = null,
        public ?string $renewMode = null,
        public ?int $paymentRuntime = null,
        public ?int $contractRuntime = null,
        public ?int $cancellationPeriod = null,
        public ?array $domains = null,
        #[MapName('approverEMailAddress')]
        public ?string $approverEmailAddress = null,
        #[MapName('activeCertificateID')]
        public ?int $activeCertificateId = null,
        #[MapName('tlsProductID')]
        public ?int $tlsProductId = null,
        public ?bool $isWildcard = null,
        public ?object $activeCertificate = null,
    ) {}
}
