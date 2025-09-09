<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Auth;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\TwoFaMethod;

/**
 * post_auth_details
 *
 * Detaillierte Informationen zu einer TwoFA<br /><br /><a target="_blank"
 * href="/core/api#auth/details">In Reseller-Interface öffnen</a>
 */
class AuthDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     */
    public function __construct(
        protected ?int $userId,
        protected TwoFaMethod $twoFaMethod,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId, 'TwoFaMethod' => $this->twoFaMethod->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/auth/details';
    }
}
