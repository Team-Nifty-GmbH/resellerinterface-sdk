<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;
use TeamNiftyGmbH\ResellerInterface\Enums\RedirectMode;

/**
 * post_domain_create
 *
 * Registriert eine neue Domain<br /><br />Benötigte Rechte:<br />**Domains bestellen**
 * (api.domain.order)<br /><br /><a target="_blank" href="/core/api#domain/create">In
 * Reseller-Interface öffnen</a>
 */
class DomainCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  array  $handles  Handles [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|RedirectMode  $redirectMode  WEB-Weiterleitungsart (optional)
     * @param  null|array  $nameserver  Externe Nameserver (nur für redirectMode=external) (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|array  $ipRedirect  Ziel IP-Adresse (nur für redirectMode=ipredirect) (optional)
     * @param  null|array  $frameRedirect  Frame-Konfiguration (nur für redirectMode=frame) (optional)
     * @param  null|array  $rrTemplate  RR-Template-Konfiguration (nur für redirectMode=rrtemplate) (optional)
     * @param  null|array  $webspace  Webspace-Konfiguration (nur für redirectMode=webspace) (optional)
     * @param  null|array  $records  DNS-Records (nur für redirectMode=individual) (optional)
     * @param  null|array  $dnssec  öffentliche DNSSEC Schlüssel (optional) [[domain/setDnssec](#post-/domain/setDnssec)]
     * @param  null|bool  $autoDnssec  (optional)
     * @param  null|array  $tldExotic  Zusatzdaten für spezielle TLDs, z.B. Steuernummern (optional) [[domain/setTldExotic](#post-/domain/setTldExotic)]
     * @param  null|int  $vnsId  ID eines virtuellen Nameservers (optional)
     * @param  null|int  $ensId  ID eines externen Nameserver-Sets (optional)
     * @param  null|string  $tag  Tag (optional)
     * @param  null|bool  $trustee  Trustee hinzufügen (optional)
     * @param  null|bool  $whoisPrivacy  Whois-Schutz hinzufügen (optional)
     * @param  null|bool  $premiumOk  (optional)
     * @param  null|string  $premiumClassOk  (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     */
    public function __construct(
        protected string $domain,
        protected array $handles,
        protected ?RedirectMode $redirectMode = null,
        protected ?array $nameserver = null,
        protected ?array $ipRedirect = null,
        protected ?array $frameRedirect = null,
        protected ?array $rrTemplate = null,
        protected ?array $webspace = null,
        protected ?array $records = null,
        protected ?array $dnssec = null,
        protected ?bool $autoDnssec = null,
        protected ?array $tldExotic = null,
        protected ?int $vnsId = null,
        protected ?int $ensId = null,
        protected ?string $tag = null,
        protected ?bool $trustee = null,
        protected ?bool $whoisPrivacy = null,
        protected ?bool $premiumOk = null,
        protected ?string $premiumClassOk = null,
        protected ?bool $fullyAsync = null,
        protected ?int $runtime = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'handles' => $this->handles,
            'redirectMode' => $this->redirectMode?->value,
            'nameserver' => $this->nameserver,
            'ipRedirect' => $this->ipRedirect,
            'frameRedirect' => $this->frameRedirect,
            'rrTemplate' => $this->rrTemplate,
            'webspace' => $this->webspace,
            'records' => $this->records,
            'dnssec' => $this->dnssec,
            'autoDnssec' => $this->autoDnssec,
            'tldExotic' => $this->tldExotic,
            'vnsID' => $this->vnsId,
            'ensID' => $this->ensId,
            'tag' => $this->tag,
            'trustee' => $this->trustee,
            'whoisPrivacy' => $this->whoisPrivacy,
            'premiumOK' => $this->premiumOk,
            'premiumClassOK' => $this->premiumClassOk,
            'fullyAsync' => $this->fullyAsync,
            'runtime' => $this->runtime,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/create';
    }
}
