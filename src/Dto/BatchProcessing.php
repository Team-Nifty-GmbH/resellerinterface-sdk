<?php

namespace TeamNiftyGmbH\ResellerInterface\Dto;

use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data as SpatieData;

class BatchProcessing extends SpatieData
{
    public function __construct(
        public ?int $id = null,
        #[MapName('resellerID')]
        public ?int $resellerId = null,
        #[MapName('userID')]
        public ?int $userId = null,
        public ?string $status = null,
        public ?int $dateStarted = null,
        public ?string $dateCompleted = null,
        public ?int $priority = null,
        public ?string $action = null,
        public ?object $params = null,
        public ?object $batchParams = null,
        public ?int $tasksTotal = null,
        public ?int $tasksCompleted = null,
        public ?int $tasksSuccessful = null,
        public ?int $tasksFailed = null,
        public ?string $tasks = null,
    ) {}
}
