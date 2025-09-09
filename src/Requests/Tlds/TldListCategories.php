<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tlds;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_tld_listCategories
 *
 * Listet TLD-Kategorien auf<br /><br /><a target="_blank" href="/core/api#tld/listCategories">In
 * Reseller-Interface öffnen</a>
 */
class TldListCategories extends Request implements HasBody
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
        return '/tld/listCategories';
    }
}
