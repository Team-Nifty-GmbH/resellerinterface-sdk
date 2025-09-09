<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum Type: string
{
    case FILES = 'files';
    case HTML = 'html';
    case MAIL = 'mail';
    case MYSQL = 'mysql';
}
