<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\DnsRecordType;
use TeamNiftyGmbH\ResellerInterface\Enums\IpVersion;
use TeamNiftyGmbH\ResellerInterface\Enums\RedirectCode;

/**
 * post_dns_createRecord
 *
 * Erstellt einen neuen Resource-Record<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR)
 * verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#dns/createRecord">In Reseller-Interface öffnen</a>
 */
class DnsCreateRecord extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $name  Resource-Name (optional)
     * @param  DnsRecordType  $type  Resource-Typ
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  string  $content  Resource-Data
     * @param  null|string  $uri  Ziel URL der Frame-/Header-Weiterleitung (optional)
     * @param  null|RedirectCode  $redirectCode  HTTP-Statuscode für die Header-Weiterleitung (optional)
     * @param  null|string  $title  Titeltext der Frame-Weiterleitung (optional)
     * @param  null|string  $desc  Beschreibungstext der Frame-Weiterleitung (optional)
     * @param  null|string  $keywords  Schlüsselwörter der Frame-Weiterleitung (optional)
     * @param  null|string  $favicon  URL zum Favoriten-Symbol der Frame-Weiterleitung (optional)
     * @param  null|int  $flexDnsuserId  Benutzer-ID des FlexDNS-Benutzers (optional)
     * @param  null|IpVersion  $flexDnsipVersion  FlexDNS Aktualisierungsbereich (optional)
     * @param  null|string  $flexDnsinterfaceId  FlexDNS IPv6-Interface-ID (optional)
     * @param  null|bool  $overwriteConflicts  Überschreiben von Records, welche in Konflikt mit dem neuem Record stehen (optional)
     */
    public function __construct(
        protected string $domain,
        protected ?string $name,
        protected DnsRecordType $type,
        protected ?int $ttl,
        protected ?int $priority,
        protected string $content,
        protected ?string $uri = null,
        protected ?RedirectCode $redirectCode = null,
        protected ?string $title = null,
        protected ?string $desc = null,
        protected ?string $keywords = null,
        protected ?string $favicon = null,
        protected ?int $flexDnsuserId = null,
        protected ?IpVersion $flexDnsipVersion = null,
        protected ?string $flexDnsinterfaceId = null,
        protected ?bool $overwriteConflicts = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'name' => $this->name,
            'type' => $this->type->value,
            'ttl' => $this->ttl,
            'priority' => $this->priority,
            'content' => $this->content,
            'uri' => $this->uri,
            'redirectCode' => $this->redirectCode?->value,
            'title' => $this->title,
            'desc' => $this->desc,
            'keywords' => $this->keywords,
            'favicon' => $this->favicon,
            'flexDNSUserID' => $this->flexDnsuserId,
            'flexDNSipVersion' => $this->flexDnsipVersion?->value,
            'flexDNSinterfaceId' => $this->flexDnsinterfaceId,
            'overwriteConflicts' => $this->overwriteConflicts,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/createRecord';
    }
}
