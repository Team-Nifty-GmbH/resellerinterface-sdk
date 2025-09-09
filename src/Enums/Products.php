<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Products: string
{
    case AUTHINFO2 = 'authinfo2';
    case CREATE = 'create';
    case CREATESETUP = 'createSetup';
    case EXTERNAL = 'external';
    case RENEW = 'renew';
    case RESTORE = 'restore';
    case RESTORESETUP = 'restoreSetup';
    case TRADE = 'trade';
    case TRANSFER = 'transfer';
    case TRANSFERSETUP = 'transferSetup';
    case TRUSTEE = 'trustee';
    case UPDATE = 'update';
}
