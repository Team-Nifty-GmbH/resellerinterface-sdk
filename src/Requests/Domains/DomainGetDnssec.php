<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_getDnssec
 *
 * Gibt die hinterlegten DNSSEC-Einträge für eine Domain zurück<br /><br />Benötigte Rechte:<br
 * />**Domains einsehen** (api.domain.view)<br /><br /><a target="_blank"
 * href="/core/api#domain/getDnssec">In Reseller-Interface öffnen</a>
 */
class DomainGetDnssec extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     */
    public function __construct(
        protected int $domain,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/getDnssec';
    }
}
