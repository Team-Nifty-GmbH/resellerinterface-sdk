<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_createFtpUser
 *
 * Erstellt einen FTP-Benutzer für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createFtpUser">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateFtpUser extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  null|string  $directory  Verzeichnis (optional)
     */
    public function __construct(
        protected ?int $webspace = null,
        protected ?int $webspaceProjectId = null,
        protected ?string $directory = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'webspaceProjectID' => $this->webspaceProjectId, 'directory' => $this->directory]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createFtpUser';
    }
}
