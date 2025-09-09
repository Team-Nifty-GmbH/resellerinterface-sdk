<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Auth;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;

/**
 * post_auth_listApiIpRestrictions
 *
 * Listet alle freigegebenen IP-Adressen für den API-Zugriff auf<br /><br /><a target="_blank"
 * href="/core/api#auth/listApiIpRestrictions">In Reseller-Interface öffnen</a>
 */
class AuthListApiIpRestrictions extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     */
    public function __construct(
        protected ?ResellerID $resellerId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId?->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/auth/listApiIpRestrictions';
    }
}
