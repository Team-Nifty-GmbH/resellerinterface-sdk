<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_deactivateDomainSafe
 *
 * Kündigt den Domain-Safe für eine Domain<br /><br />Benötigte Rechte:<br />**Domain-Safe
 * verwalten** (api.domain.domainSafe)<br /><br /><a target="_blank"
 * href="/core/api#domain/deactivateDomainSafe">In Reseller-Interface öffnen</a>
 */
class DomainDeactivateDomainSafe extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $instantCancel  Kündigung zu Sofort
     */
    public function __construct(
        protected int $domain,
        protected bool $instantCancel,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'instantCancel' => $this->instantCancel]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/deactivateDomainSafe';
    }
}
