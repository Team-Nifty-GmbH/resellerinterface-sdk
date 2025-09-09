<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_reseller_listUndeliveredMail
 *
 * Listet E-Mail-Adressen die nicht erreichbar sind auf<br /><br /><a target="_blank"
 * href="/core/api#reseller/listUndeliveredMail">In Reseller-Interface öffnen</a>
 */
class ResellerListUndeliveredMail extends Request implements HasBody
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
        return '/reseller/listUndeliveredMail';
    }
}
