<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_user_delete
 *
 * Löscht einen Benutzer<br>
 * • Der Haupt-Benutzer (main) kann nicht gelöscht werden.<br /><br
 * />Benötigte Rechte:<br />**Unterbenutzer verwalten** (api.user.manage)<br /><br /><a
 * target="_blank" href="/core/api#user/delete">In Reseller-Interface öffnen</a>
 */
class UserDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $userId  Benutzer-ID
     */
    public function __construct(
        protected int $userId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId]);
    }

    public function resolveEndpoint(): string
    {
        return '/user/delete';
    }
}
