<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_domain_listOutgoingPushRequests
 *
 * <br /><br />Benötigte Rechte:<br />**Domains einsehen** (api.domain.view)<br /><br /><a
 * target="_blank" href="/core/api#domain/listOutgoingPushRequests">In Reseller-Interface öffnen</a>
 */
class DomainListOutgoingPushRequests extends Request implements HasBody
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
        return '/domain/listOutgoingPushRequests';
    }
}
