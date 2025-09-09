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
 * post_domain_createExternal
 *
 * Registriert eine externe Domain<br /><br />Benötigte Rechte:<br />**externe Domain bestellen**
 * (api.externalDomain.order)<br /><br /><a target="_blank" href="/core/api#domain/createExternal">In
 * Reseller-Interface öffnen</a>
 */
class DomainCreateExternal extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|RedirectMode  $redirectMode  Weiterleitungsmodus (optional)
     * @param  null|array  $nameserver  Externe Nameserver (nur für redirectMode=external) (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|array  $ipRedirect  Ziel IP-Adresse (nur für redirectMode=ipredirect) (optional)
     * @param  null|array  $frameRedirect  Frame-Konfiguration (nur für redirectMode=frame) (optional)
     * @param  null|array  $rrTemplate  RR-Template-Konfiguration (nur für redirectMode=rrtemplate) (optional)
     * @param  null|array  $webspace  Webspace-Konfiguration (nur für redirectMode=webspace) (optional)
     * @param  null|array  $records  DNS-Records (nur für redirectMode=individual) (optional)
     * @param  null|array  $tldExotic  Zusatzdaten für spezielle TLDs, z.B. Steuernummern (optional) [[domain/setTldExotic](#post-/domain/setTldExotic)]
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     */
    public function __construct(
        protected string $domain,
        protected ?RedirectMode $redirectMode,
        protected ?array $nameserver,
        protected ?array $ipRedirect,
        protected ?array $frameRedirect,
        protected ?array $rrTemplate,
        protected ?array $webspace,
        protected ?array $records,
        protected ?array $tldExotic,
        protected bool $revocationAccepted,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'redirectMode' => $this->redirectMode?->value,
            'nameserver' => $this->nameserver,
            'ipRedirect' => $this->ipRedirect,
            'frameRedirect' => $this->frameRedirect,
            'rrTemplate' => $this->rrTemplate,
            'webspace' => $this->webspace,
            'records' => $this->records,
            'tldExotic' => $this->tldExotic,
            'revocationAccepted' => $this->revocationAccepted,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/createExternal';
    }
}
