<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum RedirectMode: string
{
    case FRAME = 'frame';
    case HEADER = 'header';
    case INDIVIDUAL = 'individual';
    case IPREDIRECT = 'ipredirect';
    case RRTEMPLATE = 'rrtemplate';
    case UNCONFIGURED = 'unconfigured';
    case WEBSPACE = 'webspace';
}
