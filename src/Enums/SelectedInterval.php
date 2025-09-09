<?php

declare(strict_types=1);

namespace TeamNiftyGmbH\ResellerInterface\Enums;

enum SelectedInterval: string
{
    case _12HOURS = '12hours';
    case _15MINUTES = '15minutes';
    case _1DAY = '1day';
    case _1HOUR = '1hour';
    case _1MINUTE = '1minute';
    case _1MONTH = '1month';
    case _1WEEK = '1week';
    case _1YEAR = '1year';
    case _2HOURS = '2hours';
    case _30MINUTES = '30minutes';
    case _4HOURS = '4hours';
    case _5MINUTES = '5minutes';
    case _6HOURS = '6hours';
    case _8HOURS = '8hours';
    case INDIVIDUAL = 'individual';
}
