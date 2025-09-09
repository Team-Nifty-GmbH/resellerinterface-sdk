<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Software: string
{
    case JOOMLA = 'joomla';
    case SHOPWARE = 'shopware';
    case WORDPRESS = 'wordpress';
}
