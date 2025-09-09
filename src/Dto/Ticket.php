<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class Ticket extends SpatieData
{
    public function __construct(
        #[MapName('ticketID')]
        public ?int $ticketId = null,
        #[MapName('groupID')]
        public ?string $groupId = null,
        public ?string $status = null,
        public ?string $dateCreated = null,
        public ?string $title = null,
        public ?array $messages = null,
    ) {}
}
