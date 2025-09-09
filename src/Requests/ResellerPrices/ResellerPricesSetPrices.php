<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_setPrices
 *
 * Hinterlegt Preise einer Preisliste<br /><br />Benötigte Rechte:<br />**Reseller-Preisverwaltung**
 * (api.reseller.prices)<br /><br /><a target="_blank" href="/core/api#resellerPrices/setPrices">In
 * Reseller-Interface öffnen</a>
 */
class ResellerPricesSetPrices extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|array  $products  Produkte (optional)
     * @param  null|array  $prices  Produktpreise (optional)
     */
    public function __construct(
        protected int $pricelistId,
        protected ?array $products = null,
        protected ?array $prices = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['pricelistID' => $this->pricelistId, 'products' => $this->products, 'prices' => $this->prices]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/setPrices';
    }
}
