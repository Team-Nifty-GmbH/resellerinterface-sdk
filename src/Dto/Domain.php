<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Domain extends SpatieData
{
    public function __construct(
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('domainID')]
        public ?int $domainId = null,
        public ?string $domain = null,
        public ?string $domainAce = null,
        public ?string $tld = null,
        public ?string $tldAce = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?string $exoticState = null,
        public ?string $tag = null,
        public ?string $redirectMode = null,
        public ?string $redirectTarget = null,
        public ?string $mailMode = null,
        public ?string $mailTarget = null,
        public ?string $cancellationDate = null,
        public ?array $nameserver = null,
        public ?string $premiumClass = null,
    ) {}
}
