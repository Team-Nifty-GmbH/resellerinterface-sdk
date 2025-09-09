<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum StateFilter: string
{
    case ACTIVE = 'ACTIVE';
    case ACTIVE_DISCONTINUE = 'ACTIVE_DISCONTINUE';
    case FAILED = 'FAILED';
    case FAILED_CREATE = 'FAILED_CREATE';
    case FAILED_DELETE = 'FAILED_DELETE';
    case FAILED_RESTORE = 'FAILED_RESTORE';
    case FAILED_UPDATE = 'FAILED_UPDATE';
    case INACTIVE = 'INACTIVE';
    case INACTIVE_DELETE = 'INACTIVE_DELETE';
    case INACTIVE_REVOKED = 'INACTIVE_REVOKED';
    case PENDING = 'PENDING';
    case PENDING_CREATE = 'PENDING_CREATE';
    case PENDING_DELETE = 'PENDING_DELETE';
    case PENDING_RESTORE = 'PENDING_RESTORE';
    case PENDING_UPDATE = 'PENDING_UPDATE';
    case WAITING = 'WAITING';
}
