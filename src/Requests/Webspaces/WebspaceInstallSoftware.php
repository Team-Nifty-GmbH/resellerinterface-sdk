<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Software;

/**
 * post_webspace_installSoftware
 *
 * Installiert ein CMS auf dem Webspace, legt (optional) eine Datenbank an<br /><br />Benötigte
 * Rechte:<br />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/installSoftware">In Reseller-Interface öffnen</a>
 */
class WebspaceInstallSoftware extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $webspaceDomainId  ID der Webspace-Domain
     * @param  null|int  $webspaceDatabaseId  ID der Datenbank (optional)
     * @param  Software  $software  Gewünschte Software
     * @param  null|string  $title  Webseitentitel (optional)
     * @param  null|string  $username  Nutzername für neuen Nutzer (optional)
     * @param  null|string  $password  Passwort für neuen Nutzer (optional)
     * @param  string  $email  E-Mail-Adresse für neuen Nutzer
     */
    public function __construct(
        protected int $webspace,
        protected int $webspaceDomainId,
        protected ?int $webspaceDatabaseId,
        protected Software $software,
        protected ?string $title,
        protected ?string $username,
        protected ?string $password,
        protected string $email,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'webspaceDomainID' => $this->webspaceDomainId,
            'webspaceDatabaseID' => $this->webspaceDatabaseId,
            'software' => $this->software->value,
            'title' => $this->title,
            'username' => $this->username,
            'password' => $this->password,
            'email' => $this->email,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/installSoftware';
    }
}
