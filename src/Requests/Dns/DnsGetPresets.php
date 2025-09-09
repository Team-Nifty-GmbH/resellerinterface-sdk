<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_dns_getPresets
 *
 * DNS-Presets für Web-/Mail-Weiterleitungen. Diese können als Records bei dns/createRecord verwendet
 * werden.<br /><br />Benötigte Rechte:<br />**Zonen einsehen** (api.dns.view)<br /><br /><a
 * target="_blank" href="/core/api#dns/getPresets">In Reseller-Interface öffnen</a>
 */
class DnsGetPresets extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/dns/getPresets';
    }
}
