<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Section: string
{
    case DOMAIN_DELETE = 'domain/delete';
    case RESELLER_LOGIN = 'reseller/login';
}
