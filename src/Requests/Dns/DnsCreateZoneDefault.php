<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_dns_createZoneDefault
 *
 * Erstellt eine neue Zone mit Standardwerten für SOA und Nameserver<br /><br />Benötigte Rechte:<br
 * />**Zonenkopf (SOA) verwalten** (api.dns.manageSOA)<br /><br /><a target="_blank"
 * href="/core/api#dns/createZoneDefault">In Reseller-Interface öffnen</a>
 */
class DnsCreateZoneDefault extends Request implements HasBody
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
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/createZoneDefault';
    }
}
