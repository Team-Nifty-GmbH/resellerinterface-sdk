<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;

/**
 * post_user_passwordChange
 *
 * Ändert das Password eines Benutzers<br /><br />Benötigte Rechte:<br />**Eigenes Benutzer-Passwort
 * änderbar** (api.user.passwordChange)<br /><br /><a target="_blank"
 * href="/core/api#user/passwordChange">In Reseller-Interface öffnen</a>
 */
class UserPasswordChange extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $oldPassword  Passwort
     * @param  string  $newPassword  Passwort
     */
    public function __construct(
        protected string $oldPassword,
        protected string $newPassword,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['oldPassword' => $this->oldPassword, 'newPassword' => $this->newPassword]);
    }

    public function resolveEndpoint(): string
    {
        return '/user/passwordChange';
    }
}
