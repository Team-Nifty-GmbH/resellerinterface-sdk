<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Products;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_product_listPricings
 *
 * Listet Preise auf<br /><br /><a target="_blank" href="/core/api#product/listPricings">In
 * Reseller-Interface öffnen</a>
 */
class ProductListPricings extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?array $search = null,
        protected ?array $filter = null,
        protected ?int $offset = null,
        protected ?int $limit = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['search' => $this->search, 'filter' => $this->filter, 'offset' => $this->offset, 'limit' => $this->limit]);
    }

    public function resolveEndpoint(): string
    {
        return '/product/listPricings';
    }
}
