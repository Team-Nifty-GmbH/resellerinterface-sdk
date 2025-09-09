<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_updateDatabase
 *
 * Aktualisiert die Informationen für eine Datenbank<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/updateDatabase">In Reseller-Interface öffnen</a>
 */
class WebspaceUpdateDatabase extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceDatabaseId  ID der Datenbank
     * @param  null|string  $comment  Kommentar (optional)
     */
    public function __construct(
        protected int $webspaceDatabaseId,
        protected ?string $comment = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceDatabaseID' => $this->webspaceDatabaseId, 'comment' => $this->comment]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/updateDatabase';
    }
}
