<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class WebspaceFtpUser extends SpatieData
{
    public function __construct(
        #[MapName('webspaceFtpUserID')]
        public ?int $webspaceFtpUserId = null,
        #[MapName('webspaceID')]
        public ?int $webspaceId = null,
        public ?string $directory = null,
        public ?string $name = null,
        public ?string $comment = null,
        public ?string $state = null,
        public ?string $subState = null,
    ) {}
}
