<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Auth;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_auth_setApiIpRestrictions
 *
 * Freigabe von IP-Adressen für den Zugriff auf die API<br /><br /><a target="_blank"
 * href="/core/api#auth/setApiIpRestrictions">In Reseller-Interface öffnen</a>
 */
class AuthSetApiIpRestrictions extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|array  $ip  IP-Adresse (optional)
     */
    public function __construct(
        protected ?array $ip = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['ip' => $this->ip]);
    }

    public function resolveEndpoint(): string
    {
        return '/auth/setApiIpRestrictions';
    }
}
