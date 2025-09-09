<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class RrtemplateRecord extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('rrTemplateID')]
        public ?int $rrTemplateId = null,
        public ?string $type = null,
        public ?string $name = null,
        public ?int $ttl = null,
        public ?int $priority = null,
        public ?string $content = null,
        public ?string $uri = null,
        public ?string $redirectCode = null,
        public ?string $title = null,
        public ?string $desc = null,
        public ?string $keywords = null,
        public ?string $favicon = null,
    ) {}
}
