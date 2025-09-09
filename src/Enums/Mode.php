<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Mode: string
{
    case DECREASES = 'decreases';
    case INCREASES = 'increases';
}
