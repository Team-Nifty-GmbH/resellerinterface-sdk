<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_deleteZone
 *
 * Löscht eine bestehende Zone<br /><br />Benötigte Rechte:<br />**Zonenkopf (SOA) verwalten**
 * (api.dns.manageSOA)<br /><br /><a target="_blank" href="/core/api#dns/deleteZone">In
 * Reseller-Interface öffnen</a>
 */
class DnsDeleteZone extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     */
    public function __construct(
        protected string $domain,
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
        return '/dns/deleteZone';
    }
}
