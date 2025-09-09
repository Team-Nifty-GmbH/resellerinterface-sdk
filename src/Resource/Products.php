<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Products\ProductListPricings;

class Products extends BaseResource
{
    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function productListPricings(
        ?array $search = null,
        ?array $filter = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new ProductListPricings($search, $filter, $offset, $limit));
    }
}
