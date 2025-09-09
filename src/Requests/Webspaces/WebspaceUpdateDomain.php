<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_webspace_updateDomain
 *
 * Aktualisiert die Informationen für eine Domain<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/updateDomain">In Reseller-Interface öffnen</a>
 */
class WebspaceUpdateDomain extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceDomainId  ID der Webspace-Domain
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  string  $directory  Verzeichnis
     * @param  null|int  $tlsCertificateId  SSL-Zertifikats-ID (optional)
     */
    public function __construct(
        protected int $webspaceDomainId,
        protected ?int $webspaceProjectId,
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
            'webspaceDomainID' => $this->webspaceDomainId,
            'webspaceProjectID' => $this->webspaceProjectId,
            'directory' => $this->directory,
            'tlsCertificateID' => $this->tlsCertificateId,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/updateDomain';
    }
}
