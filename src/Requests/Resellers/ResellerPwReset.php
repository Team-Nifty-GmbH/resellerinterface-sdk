<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_pwReset
 *
 * Zurücksetzen des Passwortes für den Haupt-Benutzer (main)<br>
 * • Wird nur der Benutzername
 * übergeben, dann erhält der Reseller ein Token per E-Mail.<br>
 * • Mit dem erhaltenen Token kann
 * dann ein neues Passwort gesetzt werden.<br>
 * • Für Sub-Benutzer (child) wird ein user/update auf
 * den Benutzer ausgeführt.<br /><br /><a target="_blank" href="/core/api#reseller/pwReset">In
 * Reseller-Interface öffnen</a>
 */
class ResellerPwReset extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $username  Benutzername
     * @param  null|string  $password  Passwort (optional)
     * @param  null|string  $token  Token zur Änderung (optional)
     */
    public function __construct(
        protected string $username,
        protected ?string $password = null,
        protected ?string $token = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['username' => $this->username, 'password' => $this->password, 'token' => $this->token]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/pwReset';
    }
}
