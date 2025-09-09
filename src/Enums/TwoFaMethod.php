<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum TwoFaMethod: string
{
    case NONE = 'none';
    case PASSWORD = 'password';
    case TOTP = 'totp';
    case WEBAUTHN = 'webauthn';
}
