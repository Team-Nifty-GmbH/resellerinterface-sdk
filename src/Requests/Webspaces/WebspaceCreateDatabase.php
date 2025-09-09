<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_createDatabase
 *
 * Erstellt eine Datenbank für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createDatabase">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateDatabase extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $comment  Kommentar (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     */
    public function __construct(
        protected ?int $webspace = null,
        protected ?string $comment = null,
        protected ?bool $waitForResponse = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'comment' => $this->comment, 'waitForResponse' => $this->waitForResponse]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createDatabase';
    }
}
