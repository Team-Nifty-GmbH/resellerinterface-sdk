<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Action: string
{
    case DELETE = 'delete';
    case SET = 'set';
}
