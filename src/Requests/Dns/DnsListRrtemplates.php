<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_dns_listRRTemplates
 *
 * Listet alle Resource-Record-Templates auf<br /><br />Benötigte Rechte:<br />**Resourcentemplates
 * verwalten** (api.rrtemplate.manage)<br /><br /><a target="_blank"
 * href="/core/api#dns/listRRTemplates">In Reseller-Interface öffnen</a>
 */
class DnsListRrtemplates extends Request implements HasBody
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
        return '/dns/listRRTemplates';
    }
}
