<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_listModules
 *
 * Listet Module auf<br /><br />Benötigte Rechte:<br />**Reseller-Zusatzmodule bestellen**
 * (api.resellerModule.order)<br /><br /><a target="_blank" href="/core/api#reseller/listModules">In
 * Reseller-Interface öffnen</a>
 */
class ResellerListModules extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/listModules';
    }
}
