<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_enableDnssec
 *
 * Aktiviert DNSSEC auf den internen Nameservern<br /><br />Benötigte Rechte:<br />**DNSSEC
 * verwalten** (api.dnssec.manage)<br />**Domains verwalten** (api.domain.manage)<br /><br /><a
 * target="_blank" href="/core/api#dns/enableDnssec">In Reseller-Interface öffnen</a>
 */
class DnsEnableDnssec extends Request implements HasBody
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
        return '/dns/enableDnssec';
    }
}
