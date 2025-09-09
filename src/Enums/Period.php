<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Period: string
{
    case _30 = '30';
    case _365 = '365';
    case ALL = 'all';
}
