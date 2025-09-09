<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;

/**
 * post_reseller_login
 *
 * Anmeldung als Benutzer an der CoreAPI<br /><br /><a target="_blank"
 * href="/core/api#reseller/login">In Reseller-Interface öffnen</a>
 */
class ResellerLogin extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $username  Benutzername
     * @param  string  $password  Passwort
     * @param  null|string  $sms  TwoFA SMS-Code (optional)
     * @param  null|string  $totp  TwoFA TOTP-Code (optional)
     */
    public function __construct(
        protected string $username,
        protected string $password,
        protected ?string $sms = null,
        protected ?string $totp = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Reseller::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['username' => $this->username, 'password' => $this->password, 'sms' => $this->sms, 'totp' => $this->totp]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/login';
    }
}
