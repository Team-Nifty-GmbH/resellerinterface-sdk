<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;

/**
 * post_reseller_logoutReseller
 *
 * Aus einem Sub-Reseller (child) in den Ober-Reseller (parent) wechseln<br /><br />Benötigte
 * Rechte:<br />**Unterreseller verwalten** (api.reseller.manage)<br /><br /><a target="_blank"
 * href="/core/api#reseller/logoutReseller">In Reseller-Interface öffnen</a>
 */
class ResellerLogoutReseller extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Reseller::from($response->json() ?? []);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/logoutReseller';
    }
}
