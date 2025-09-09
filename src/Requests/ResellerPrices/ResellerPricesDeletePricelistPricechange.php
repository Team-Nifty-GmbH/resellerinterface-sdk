<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_deletePricelistPricechange
 *
 * Löscht eine Preisänderung einer Preisliste<br /><br />Benötigte Rechte:<br
 * />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/deletePricelistPricechange">In Reseller-Interface öffnen</a>
 */
class ResellerPricesDeletePricelistPricechange extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricechangeId  Preisänderung-ID
     */
    public function __construct(
        protected int $pricechangeId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['pricechangeID' => $this->pricechangeId]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/deletePricelistPricechange';
    }
}
