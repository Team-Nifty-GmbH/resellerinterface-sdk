<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_setDatabasePassword
 *
 * Ändert das Datenbank-Passwort<br /><br />Benötigte Rechte:<br />**Webspacepakete verwalten**
 * (api.webspace.manage)<br /><br /><a target="_blank" href="/core/api#webspace/setDatabasePassword">In
 * Reseller-Interface öffnen</a>
 */
class WebspaceSetDatabasePassword extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $password  Passwort
     */
    public function __construct(
        protected int $webspace,
        protected string $password,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'password' => $this->password]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/setDatabasePassword';
    }
}
