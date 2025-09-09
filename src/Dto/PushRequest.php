<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class PushRequest extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('targetResellerID')]
        public ?int $targetResellerId = null,
        public ?string $dateCreated = null,
        public ?string $dateExecuted = null,
        public ?string $dateExpire = null,
        public ?string $status = null,
        public ?bool $cloneSettings = null,
        public ?bool $cloneHandles = null,
    ) {}
}
