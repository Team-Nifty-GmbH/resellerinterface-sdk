<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_detailsPricelist
 *
 * Ruft Informationen zu einer Preisliste ab<br /><br />Benötigte Rechte:<br
 * />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/detailsPricelist">In Reseller-Interface öffnen</a>
 */
class ResellerPricesDetailsPricelist extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricelistId  Preislisten-ID
     */
    public function __construct(
        protected int $pricelistId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['pricelistID' => $this->pricelistId]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/detailsPricelist';
    }
}
