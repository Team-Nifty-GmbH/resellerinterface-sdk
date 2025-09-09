<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum ResellerID: string
{
    case ALL = 'ALL';
    case OWN = 'OWN';
    case SUB = 'SUB';
}
