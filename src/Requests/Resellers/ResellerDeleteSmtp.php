<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_reseller_deleteSMTP
 *
 * <br /><br />Benötigte Rechte:<br />**Interfacebranding verwalten** (api.reseller.branding)<br /><br
 * /><a target="_blank" href="/core/api#reseller/deleteSMTP">In Reseller-Interface öffnen</a>
 */
class ResellerDeleteSmtp extends Request implements HasBody
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
        return '/reseller/deleteSMTP';
    }
}
