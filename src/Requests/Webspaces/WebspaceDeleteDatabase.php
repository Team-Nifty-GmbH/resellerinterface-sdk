<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteDatabase
 *
 * Löscht eine Datenbank für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/deleteDatabase">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteDatabase extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceDatabaseId  ID der Datenbank
     */
    public function __construct(
        protected int $webspaceDatabaseId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceDatabaseID' => $this->webspaceDatabaseId]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteDatabase';
    }
}
