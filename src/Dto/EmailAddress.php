<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class EmailAddress extends SpatieData
{
    public function __construct(
        #[MapName('eMailAddressID')]
        public ?int $eMailAddressId = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('domainID')]
        public ?int $domainId = null,
        #[MapName('inboxID')]
        public ?int $inboxId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?string $eMailAddress = null,
        public ?string $comment = null,
        public ?string $domain = null,
        public ?string $local = null,
        public ?string $type = null,
        #[MapName('redirectEMailAddresses')]
        public ?array $redirectEmailAddresses = null,
    ) {}
}
