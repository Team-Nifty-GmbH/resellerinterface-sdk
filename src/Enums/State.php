<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum State: string
{
    case ACTIVE = 'ACTIVE';
    case INACTIVE = 'INACTIVE';
}
