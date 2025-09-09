<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_setDnssec
 *
 * Merkt neue DNSSEC-Einträge für eine Domain vor. Zur Durchführung der Änderung muss noch
 * [domain/update](#post-/domain/update) ausgeführt werden.<br /><br />Benötigte Rechte:<br
 * />**Domains verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domain/setDnssec">In Reseller-Interface öffnen</a>
 */
class DomainSetDnssec extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  array  $dnssec  Die DNSSEC-Einträge
     */
    public function __construct(
        protected int $domain,
        protected array $dnssec,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'dnssec' => $this->dnssec]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setDnssec';
    }
}
