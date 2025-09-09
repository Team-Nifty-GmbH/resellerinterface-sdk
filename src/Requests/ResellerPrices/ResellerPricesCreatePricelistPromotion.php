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
 * post_resellerPrices_createPricelistPromotion
 *
 * Erstellt eine Promo einer Preisliste<br /><br />Benötigte Rechte:<br />**Reseller-Preisverwaltung**
 * (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/createPricelistPromotion">In Reseller-Interface öffnen</a>
 */
class ResellerPricesCreatePricelistPromotion extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  int  $name  Promo-Name
     * @param  Group  $group  Produkt-Gruppe
     * @param  Products  $product  Produkt-Name
     * @param  string  $variant  Produkt-Variante
     * @param  null|float|int  $price  Preis (optional)
     * @param  string  $validFrom  Gültig von
     * @param  string  $validTo  Gültig bis
     */
    public function __construct(
        protected int $pricelistId,
        protected int $name,
        protected Group $group,
        protected Products $product,
        protected string $variant,
        protected float|int|null $price = null,
        protected string $validFrom,
        protected string $validTo,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'pricelistID' => $this->pricelistId,
            'name' => $this->name,
            'group' => $this->group->value,
            'product' => $this->product->value,
            'variant' => $this->variant,
            'price' => $this->price,
            'validFrom' => $this->validFrom,
            'validTo' => $this->validTo,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/createPricelistPromotion';
    }
}
