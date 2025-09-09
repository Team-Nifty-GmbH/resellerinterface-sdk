<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteFtpUser
 *
 * Löscht einen FTP-Benutzer für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/deleteFtpUser">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteFtpUser extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceFtpUserId  ID des FTP-Benutzers
     */
    public function __construct(
        protected int $webspaceFtpUserId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceFtpUserID' => $this->webspaceFtpUserId]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteFtpUser';
    }
}
