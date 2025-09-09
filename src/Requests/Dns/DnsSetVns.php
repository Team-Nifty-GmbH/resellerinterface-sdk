<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_dns_setVNS
 *
 * Ändert die Zone auf die virtuellen Nameserver ab. Und hinterlegt ein offenes Nameserver-Update in
 * der Domain<br /><br />Benötigte Rechte:<br />**Zonenkopf (SOA) verwalten** (api.dns.manageSOA)<br
 * /><br /><a target="_blank" href="/core/api#dns/setVNS">In Reseller-Interface öffnen</a>
 */
class DnsSetVns extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  int  $vnsId  ID eines virtuellen Nameservers
     * @param  null|bool  $forceDomainUpdate  Führt sofortiges update der Nameserver aus (optional, default: false) (optional)
     */
    public function __construct(
        protected string $domain,
        protected int $vnsId,
        protected ?bool $forceDomainUpdate = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'vnsID' => $this->vnsId, 'forceDomainUpdate' => $this->forceDomainUpdate]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/setVNS';
    }
}
