<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Webspace extends SpatieData
{
    public function __construct(
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        public ?string $alias = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('serverID')]
        public ?int $serverId = null,
        #[MapName('packageID')]
        public ?int $packageId = null,
        public ?string $packageName = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?string $lastBillingDate = null,
        public ?string $nextBillingDate = null,
        public ?string $createDate = null,
        public ?string $lockDate = null,
        public ?string $lockReason = null,
        public ?string $deleteMode = null,
        public ?string $deleteDate = null,
        public ?string $cleanupDate = null,
        public ?string $cancellationDate = null,
        public ?string $cancellationInitiatedDate = null,
        public ?bool $cancellationRevokable = null,
        public ?bool $restorable = null,
        public ?string $tag = null,
        public ?string $comment = null,
        public ?object $contactAddress = null,
    ) {}
}
