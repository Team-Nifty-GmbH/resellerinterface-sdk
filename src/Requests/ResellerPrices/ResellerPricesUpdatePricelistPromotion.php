<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Group;
use TeamNiftyGmbH\ResellerInterface\Enums\Products;

/**
 * post_resellerPrices_updatePricelistPromotion
 *
 * Aktualisiert eine Promo einer Preisliste<br /><br />Benötigte Rechte:<br
 * />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/updatePricelistPromotion">In Reseller-Interface öffnen</a>
 */
class ResellerPricesUpdatePricelistPromotion extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $promotionId  Promo-ID
     * @param  null|int  $name  Promo-Name (optional)
     * @param  null|Group  $group  Produkt-Gruppe (optional)
     * @param  null|Products  $product  Produkt-Name (optional)
     * @param  null|string  $variant  Produkt-Variante (optional)
     * @param  null|float|int  $price  Preis (optional)
     * @param  null|string  $validFrom  Gültig von (optional)
     * @param  null|string  $validTo  Gültig bis (optional)
     */
    public function __construct(
        protected int $promotionId,
        protected ?int $name = null,
        protected ?Group $group = null,
        protected ?Products $product = null,
        protected ?string $variant = null,
        protected float|int|null $price = null,
        protected ?string $validFrom = null,
        protected ?string $validTo = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'promotionID' => $this->promotionId,
            'name' => $this->name,
            'group' => $this->group?->value,
            'product' => $this->product?->value,
            'variant' => $this->variant,
            'price' => $this->price,
            'validFrom' => $this->validFrom,
            'validTo' => $this->validTo,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/updatePricelistPromotion';
    }
}
