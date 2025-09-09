<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum RenewalMode: string
{
    case AUTODELETE = 'autoDelete';
    case AUTORENEW = 'autoRenew';
}
