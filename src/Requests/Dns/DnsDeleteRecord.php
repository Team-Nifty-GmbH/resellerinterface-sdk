<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_deleteRecord
 *
 * Löscht einen bestehenden Resource-Record<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR)
 * verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#dns/deleteRecord">In Reseller-Interface öffnen</a>
 */
class DnsDeleteRecord extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  int  $id  Record-ID
     */
    public function __construct(
        protected string $domain,
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'id' => $this->id]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/deleteRecord';
    }
}
