<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceDomain extends SpatieData
{
    public function __construct(
        #[MapName('webspaceDomainID')]
        public ?int $webspaceDomainId = null,
        #[MapName('webspaceProjectID')]
        public ?int $webspaceProjectId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        #[MapName('domainID')]
        public ?int $domainId = null,
        public ?string $directory = null,
        public ?string $state = null,
        public ?string $subState = null,
    ) {}
}
