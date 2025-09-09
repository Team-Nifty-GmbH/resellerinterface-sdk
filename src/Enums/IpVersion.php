<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum IpVersion: string
{
    case BOTH = 'both';
    case IPV4 = 'IPv4';
    case IPV4ANDIPV6PREFIX = 'IPv4andIPv6prefix';
    case IPV6 = 'IPv6';
    case IPV6PREFIXONLY = 'IPv6prefixOnly';
}
