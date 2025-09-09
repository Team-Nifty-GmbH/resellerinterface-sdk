<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Auth;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_auth_generateSecret
 *
 * Erzeugt einen geheimen Schlüssel für die TOTP-Methode<br /><br /><a target="_blank"
 * href="/core/api#auth/generateSecret">In Reseller-Interface öffnen</a>
 */
class AuthGenerateSecret extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/auth/generateSecret';
    }
}
