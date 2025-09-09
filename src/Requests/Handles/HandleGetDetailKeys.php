<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Handles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_handle_getDetailKeys
 *
 * Gibt alle Zusatzparameter aus, welche einem Handle zugeordnet werden können<br /><br /><a
 * target="_blank" href="/core/api#handle/getDetailKeys">In Reseller-Interface öffnen</a>
 */
class HandleGetDetailKeys extends Request implements HasBody
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
        return '/handle/getDetailKeys';
    }
}
