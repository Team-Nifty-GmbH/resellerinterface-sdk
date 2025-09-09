<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_webspace_createDomain
 *
 * Erstellt eine Domain für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createDomain">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateDomain extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|int  $domain  Domain-ID oder Domainname (optional)
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  string  $subdomain  Subdomain
     * @param  string  $directory  Verzeichnis
     * @param  null|int  $tlsCertificateId  SSL-Zertifikats-ID (optional)
     */
    public function __construct(
        protected ?int $webspace,
        protected ?int $domain,
        protected ?int $webspaceProjectId,
        protected string $subdomain,
        protected string $directory,
        protected ?int $tlsCertificateId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'domain' => $this->domain,
            'webspaceProjectID' => $this->webspaceProjectId,
            'subdomain' => $this->subdomain,
            'directory' => $this->directory,
            'tlsCertificateID' => $this->tlsCertificateId,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createDomain';
    }
}
