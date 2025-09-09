<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;

/**
 * post_user_logoutUser
 *
 * Aus einem Sub-Benutzer (child) in den eigenen Benutzer wechseln<br /><br />Benötigte Rechte:<br
 * />**Unterbenutzer verwalten** (api.user.manage)<br /><br /><a target="_blank"
 * href="/core/api#user/logoutUser">In Reseller-Interface öffnen</a>
 */
class UserLogoutUser extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function resolveEndpoint(): string
    {
        return '/user/logoutUser';
    }
}
