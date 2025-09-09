<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_activateDomainSafe
 *
 * Aktiviert den Domain-Safe für eine Domain<br /><br />Benötigte Rechte:<br />**Domain-Safe
 * verwalten** (api.domain.domainSafe)<br /><br /><a target="_blank"
 * href="/core/api#domain/activateDomainSafe">In Reseller-Interface öffnen</a>
 */
class DomainActivateDomainSafe extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     */
    public function __construct(
        protected int $domain,
        protected bool $revocationAccepted,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'revocationAccepted' => $this->revocationAccepted]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/activateDomainSafe';
    }
}
