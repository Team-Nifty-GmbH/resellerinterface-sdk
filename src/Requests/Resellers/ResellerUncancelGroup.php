<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_reseller_uncancelGroup
 *
 * Reseller-Paket-Kündigung widerrufen<br /><br />Benötigte Rechte:<br />**Reseller-Zusatzmodule
 * kündigen** (api.resellerModule.delete)<br /><br /><a target="_blank"
 * href="/core/api#reseller/uncancelGroup">In Reseller-Interface öffnen</a>
 */
class ResellerUncancelGroup extends Request implements HasBody
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
        return '/reseller/uncancelGroup';
    }
}
