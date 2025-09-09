<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_dns_listRecords
 *
 * Ruft eine Zone samt SOA und Records ab (alias von dns/getZoneDetails)<br /><br />Benötigte
 * Rechte:<br />**Zonen einsehen** (api.dns.view)<br /><br /><a target="_blank"
 * href="/core/api#dns/listRecords">In Reseller-Interface öffnen</a>
 */
class DnsListRecords extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     */
    public function __construct(
        protected string $domain,
        protected ?string $search = null,
        protected ?array $filter = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'search' => $this->search, 'filter' => $this->filter]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/listRecords';
    }
}
