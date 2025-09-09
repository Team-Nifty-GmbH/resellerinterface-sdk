<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Auth;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_auth_sendSMSCodeForLogin
 *
 * <br /><br /><a target="_blank" href="/core/api#auth/sendSMSCodeForLogin">In Reseller-Interface
 * öffnen</a>
 */
class AuthSendSmscodeForLogin extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $username  Benutzername
     * @param  string  $password  Passwort
     */
    public function __construct(
        protected string $username,
        protected string $password,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['username' => $this->username, 'password' => $this->password]);
    }

    public function resolveEndpoint(): string
    {
        return '/auth/sendSMSCodeForLogin';
    }
}
