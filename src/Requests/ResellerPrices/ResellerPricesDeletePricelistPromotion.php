<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_deletePricelistPromotion
 *
 * Löscht eine Promo einer Preisliste<br /><br />Benötigte Rechte:<br />**Reseller-Preisverwaltung**
 * (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/deletePricelistPromotion">In Reseller-Interface öffnen</a>
 */
class ResellerPricesDeletePricelistPromotion extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $promotionId  Promo-ID
     */
    public function __construct(
        protected int $promotionId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['promotionID' => $this->promotionId]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/deletePricelistPromotion';
    }
}
