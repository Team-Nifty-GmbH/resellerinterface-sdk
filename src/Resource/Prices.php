<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Prices\PricesDomains;
use TeamNiftyGmbH\ResellerInterface\Requests\Prices\PricesTaxRate;
use TeamNiftyGmbH\ResellerInterface\Requests\Prices\PricesTls;
use TeamNiftyGmbH\ResellerInterface\Requests\Prices\PricesWebspaces;

class Prices extends BaseResource
{
    /**
     * @param  null|array  $category  TLD-Kategorie (optional)
     * @param  null|bool  $details  Details (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pricesDomains(
        ?array $category = null,
        ?bool $details = null,
        ?int $runtime = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new PricesDomains($category, $details, $runtime, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  null|string  $productGroup  Produkt-Gruppe (optional)
     * @param  null|string  $productName  Produktname (optional)
     * @param  null|string  $date  Datum (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pricesTaxRate(
        ?string $productGroup = null,
        ?string $productName = null,
        ?string $date = null,
    ): Response {
        return $this->connector->send(new PricesTaxRate($productGroup, $productName, $date));
    }

    /**
     * @param  null|bool  $details  Details (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pricesTls(
        ?bool $details = null,
        ?int $runtime = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new PricesTls($details, $runtime, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  null|bool  $details  Details (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pricesWebspaces(
        ?bool $details = null,
        ?int $runtime = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?array $include = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new PricesWebspaces($details, $runtime, $search, $filter, $sort, $include, $offset, $limit));
    }
}
