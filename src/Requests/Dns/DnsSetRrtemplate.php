<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_setRRTemplate
 *
 * Wendet ein Resource-Record-Template auf eine Zone an<br /><br />Benötigte Rechte:<br
 * />**Zonenrecords (RR) verwalten** (api.dns.manageRecords)<br />**Resourcentemplates verwalten**
 * (api.rrtemplate.manage)<br /><br /><a target="_blank" href="/core/api#dns/setRRTemplate">In
 * Reseller-Interface öffnen</a>
 */
class DnsSetRrtemplate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|bool  $clearZone  Zone vor Anwendung löschen (optional)
     * @param  null|bool  $backupZone  Backup der Zone vor Anwendung erstellen (optional)
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     * @param  null|string  $ipv4  Wert für IPv4-Platzhalter (optional)
     * @param  null|string  $ipv6  Wert für IPv6-Platzhalter (optional)
     * @param  null|string  $mxIpv4  Wert für mxIPv4-Platzhalter (optional)
     * @param  null|string  $mxIpv6  Wert für mxIPv6-Platzhalter (optional)
     * @param  null|string  $custom1  (optional)
     * @param  null|string  $custom2  Wert für Custom2-Platzhalter (optional)
     */
    public function __construct(
        protected string $domain,
        protected ?bool $clearZone,
        protected ?bool $backupZone,
        protected int $rrtemplateId,
        protected ?string $ipv4 = null,
        protected ?string $ipv6 = null,
        protected ?string $mxIpv4 = null,
        protected ?string $mxIpv6 = null,
        protected ?string $custom1 = null,
        protected ?string $custom2 = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'clearZone' => $this->clearZone,
            'backupZone' => $this->backupZone,
            'RRTemplateID' => $this->rrtemplateId,
            'IPv4' => $this->ipv4,
            'IPv6' => $this->ipv6,
            'mxIPv4' => $this->mxIpv4,
            'mxIPv6' => $this->mxIpv6,
            'CUSTOM1' => $this->custom1,
            'CUSTOM2' => $this->custom2,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/setRRTemplate';
    }
}
