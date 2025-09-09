<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteProject
 *
 * Löscht ein Projektverzeichnis für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/deleteProject">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteProject extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspaceProjectId  Webspace-Projekt-ID (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $directory  Verzeichnis (optional)
     * @param  null|bool  $force  Erzwingen (optional)
     */
    public function __construct(
        protected ?int $webspaceProjectId = null,
        protected ?int $webspace = null,
        protected ?string $directory = null,
        protected ?bool $force = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspaceProjectID' => $this->webspaceProjectId,
            'webspace' => $this->webspace,
            'directory' => $this->directory,
            'force' => $this->force,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteProject';
    }
}
