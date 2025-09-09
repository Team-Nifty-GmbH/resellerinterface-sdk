<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_domain_getAuthDomainSafe
 *
 * Fragt die aktuell aktive TwoFA-Methode für den Domain-Safe ab<br /><br />Benötigte Rechte:<br
 * />**Domain-Safe verwalten** (api.domain.domainSafe)<br /><br /><a target="_blank"
 * href="/core/api#domain/getAuthDomainSafe">In Reseller-Interface öffnen</a>
 */
class DomainGetAuthDomainSafe extends Request implements HasBody
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
        return '/domain/getAuthDomainSafe';
    }
}
