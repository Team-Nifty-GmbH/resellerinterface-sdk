<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum ExpireDays: string
{
    case _14 = '14';
    case _30 = '30';
    case _7 = '7';
    case EMPTY = '';
}
