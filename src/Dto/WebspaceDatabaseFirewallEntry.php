<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceDatabaseFirewallEntry extends SpatieData
{
    public function __construct(
        #[MapName('webspaceDatabaseFirewallEntryID')]
        public ?int $webspaceDatabaseFirewallEntryId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('webspaceServerID')]
        public ?int $webspaceServerId = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?string $ip = null,
        public ?string $comment = null,
    ) {}
}
