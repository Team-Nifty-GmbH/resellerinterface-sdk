<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_getCertificatesForDomain
 *
 * Ruft die SSL-Zertifikate für eine Domain ab<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate
 * einsehen** (api.tls.view)<br />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a
 * target="_blank" href="/core/api#webspace/getCertificatesForDomain">In Reseller-Interface öffnen</a>
 */
class WebspaceGetCertificatesForDomain extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspaceDomainId  ID der Webspace-Domain (optional)
     * @param  null|int  $domain  Domain-ID oder Domainname (optional)
     * @param  string  $subdomain  Subdomain
     */
    public function __construct(
        protected ?int $webspaceDomainId,
        protected ?int $domain,
        protected string $subdomain,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceDomainID' => $this->webspaceDomainId, 'domain' => $this->domain, 'subdomain' => $this->subdomain]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/getCertificatesForDomain';
    }
}
