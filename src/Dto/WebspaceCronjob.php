<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceCronjob extends SpatieData
{
    public function __construct(
        #[MapName('webspaceCronjobID')]
        public ?int $webspaceCronjobId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        public ?string $name = null,
        public ?string $command = null,
        public ?string $state = null,
        public ?string $subState = null,
        public ?bool $active = null,
        public ?string $selectedInterval = null,
        public ?string $cronIntervalInterval = null,
    ) {}
}
