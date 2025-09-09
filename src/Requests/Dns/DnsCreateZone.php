<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_dns_createZone
 *
 * Erstellt eine neue Zone<br /><br />Benötigte Rechte:<br />**Zonenkopf (SOA) verwalten**
 * (api.dns.manageSOA)<br /><br /><a target="_blank" href="/core/api#dns/createZone">In
 * Reseller-Interface öffnen</a>
 */
class DnsCreateZone extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  string  $primary  Primärer Nameserver für die Zone
     * @param  string  $mail  E-Mail-Adresse der Verantwortlichen für die Zone
     * @param  null|int  $refresh  Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $retry  Erneuter Versuch der Aktualisierung der sekundären Nameserver (optional)
     * @param  null|int  $expire  Ablauf der Zone wenn kein Aktualisierung der sekundären Nameserver erfolgt (optional)
     * @param  null|int  $minimum  Minimum TTL der Resource Records (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  null|int  $vnsId  ID eines virtuellen Nameservers (optional)
     */
    public function __construct(
        protected string $domain,
        protected string $primary,
        protected string $mail,
        protected ?int $refresh = null,
        protected ?int $retry = null,
        protected ?int $expire = null,
        protected ?int $minimum = null,
        protected ?int $ttl = null,
        protected ?int $vnsId = null,
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
        return '/dns/createZone';
    }
}
