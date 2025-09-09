<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class User extends SpatieData
{
    public function __construct(
        #[MapName('userID')]
        public ?int $userId = null,
        public ?bool $mainUser = null,
        public ?string $state = null,
        public ?string $username = null,
        public ?string $password = null,
        public ?object $settings = null,
        public ?int $rightsCategory = null,
        public ?array $rightsGroups = null,
        public ?object $directRights = null,
        public ?object $rights = null,
    ) {}
}
