<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_dns_updateZone
 *
 * Ändert eine bestehende Zone<br /><br />Benötigte Rechte:<br />**Zonenkopf (SOA) verwalten**
 * (api.dns.manageSOA)<br /><br /><a target="_blank" href="/core/api#dns/updateZone">In
 * Reseller-Interface öffnen</a>
 */
class DnsUpdateZone extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $primary  Primärer Nameserver für die Zone (optional)
     * @param  null|string  $mail  E-Mail-Adresse der Verantwortlichen für die Zone (optional)
     * @param  null|int  $refresh  Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $retry  Erneuter Versuch der Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $expire  Ablauf der Zone wenn kein Aktualisierung der sekundären Nameserver erfolgt (optional)
     * @param  null|int  $minimum  Minimum TTL der Resource Records (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  int  $vnsId  ID eines virtuellen Nameservers
     */
    public function __construct(
        protected string $domain,
        protected ?string $primary,
        protected ?string $mail,
        protected ?int $refresh,
        protected ?int $retry,
        protected ?int $expire,
        protected ?int $minimum,
        protected ?int $ttl,
        protected int $vnsId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'primary' => $this->primary,
            'mail' => $this->mail,
            'refresh' => $this->refresh,
            'retry' => $this->retry,
            'expire' => $this->expire,
            'minimum' => $this->minimum,
            'ttl' => $this->ttl,
            'vnsID' => $this->vnsId,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/updateZone';
    }
}
