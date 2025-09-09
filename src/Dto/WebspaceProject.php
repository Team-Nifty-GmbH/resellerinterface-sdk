<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceProject extends SpatieData
{
    public function __construct(
        #[MapName('webspaceProjectID')]
        public ?int $webspaceProjectId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        public ?string $directory = null,
    ) {}
}
