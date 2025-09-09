<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum SubresellerInheritanceMode: string
{
    case FIXED = 'fixed';
    case FIXED_CUSTOM = 'fixed_custom';
    case INHERIT = 'inherit';
    case NONE = 'none';
    case OPTIONAL = 'optional';
    case RECURSIVE = 'recursive';
    case RECURSIVE_CUSTOM = 'recursive_custom';
}
