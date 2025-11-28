<?php

namespace TeamNiftyGmbH\ResellerInterface\Contracts;

/**
 * Marker interface for requests that should not have resellerId auto-injected.
 *
 * Some API endpoints (like invoice/listItems) refuse the resellerId parameter.
 * Implement this interface on those requests to skip automatic injection.
 */
interface SkipsResellerIdInjection {}
