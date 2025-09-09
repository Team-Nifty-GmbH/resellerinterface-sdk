<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum DeleteMode: string
{
    case DEL = 'DEL';
    case DISCOTRANSIT = 'DISCOTRANSIT';
    case TRANSIT = 'TRANSIT';
}
