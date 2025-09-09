<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_createProject
 *
 * Erstellt ein Projektverzeichnis für ein Webspace<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createProject">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateProject extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $directory  Verzeichnis
     */
    public function __construct(
        protected int $webspace,
        protected string $directory,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'directory' => $this->directory]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createProject';
    }
}
