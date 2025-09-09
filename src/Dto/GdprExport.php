<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class GdprExport extends SpatieData
{
    public function __construct(
        public ?bool $requested = null,
        public ?int $dateGenerated = null,
        #[MapName('fileID')]
        public ?int $fileId = null,
        public ?int $dateUntil = null,
    ) {}
}
