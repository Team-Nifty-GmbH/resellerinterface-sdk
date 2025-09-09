<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceDatabase extends SpatieData
{
    public function __construct(
        #[MapName('webspaceDatabaseID')]
        public ?int $webspaceDatabaseId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        public ?string $name = null,
        public ?string $comment = null,
        public ?string $state = null,
        public ?string $subState = null,
    ) {}
}
