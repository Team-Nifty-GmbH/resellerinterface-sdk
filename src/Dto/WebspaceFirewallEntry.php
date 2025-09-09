<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceFirewallEntry extends SpatieData
{
    public function __construct(
        #[MapName('webspaceFirewallEntryID')]
        public ?int $webspaceFirewallEntryId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        #[MapName('webspaceServerID')]
        public ?int $webspaceServerId = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?string $type = null,
        public ?string $ip = null,
        public ?string $port = null,
        public ?string $comment = null,
        public ?string $requests = null,
        public ?string $dateLastRequest = null,
    ) {}
}
