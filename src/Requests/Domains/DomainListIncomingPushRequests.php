<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_domain_listIncomingPushRequests
 *
 * Listet eingehende Domain-Push-Aufträge auf<br /><br />Benötigte Rechte:<br />**Domains einsehen**
 * (api.domain.view)<br /><br /><a target="_blank" href="/core/api#domain/listIncomingPushRequests">In
 * Reseller-Interface öffnen</a>
 */
class DomainListIncomingPushRequests extends Request implements HasBody
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
        return '/domain/listIncomingPushRequests';
    }
}
