<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum DnsRecordType: string
{
    case A = 'A';
    case AAAA = 'AAAA';
    case CAA = 'CAA';
    case CNAME = 'CNAME';
    case DNSKEY = 'DNSKEY';
    case DS = 'DS';
    case FRAME = 'FRAME';
    case HEADER = 'HEADER';
    case MX = 'MX';
    case NS = 'NS';
    case NSEC = 'NSEC';
    case NSEC3 = 'NSEC3';
    case NSEC3PARAM = 'NSEC3PARAM';
    case PTR = 'PTR';
    case RRSIG = 'RRSIG';
    case SOA = 'SOA';
    case SRV = 'SRV';
    case TLSA = 'TLSA';
    case TXT = 'TXT';
}
