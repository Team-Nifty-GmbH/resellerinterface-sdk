<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_updateFtpUser
 *
 * Aktualisiert die Informationen für einen FTP-Benutzer<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/updateFtpUser">In Reseller-Interface öffnen</a>
 */
class WebspaceUpdateFtpUser extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceFtpUserId  ID des FTP-Benutzers
     * @param  null|int  $comment  Kommentar (optional)
     * @param  null|string  $password  Passwort (optional)
     */
    public function __construct(
        protected int $webspaceFtpUserId,
        protected ?int $comment = null,
        protected ?string $password = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceFtpUserID' => $this->webspaceFtpUserId, 'comment' => $this->comment, 'password' => $this->password]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/updateFtpUser';
    }
}
