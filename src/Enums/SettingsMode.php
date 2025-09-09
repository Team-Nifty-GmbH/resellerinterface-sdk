<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum SettingsMode: string
{
    case ADD = 'add';
    case CLEAR = 'clear';
    case REMOVE = 'remove';
    case SET = 'set';
}
