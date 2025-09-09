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
 * post_resellerPrices_updatePricelistPricechange
 *
 * Aktualisiert die Preisänderung einer Preisliste<br /><br />Benötigte Rechte:<br
 * />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/updatePricelistPricechange">In Reseller-Interface öffnen</a>
 */
class ResellerPricesUpdatePricelistPricechange extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricechangeId  Preisänderung-ID
     * @param  null|int  $name  Preisänderung-Name (optional)
     * @param  null|Group  $group  Produkt-Gruppe (optional)
     * @param  null|Products  $product  Produkt-Name (optional)
     * @param  null|string  $variant  Produkt-Variante (optional)
     * @param  null|float|int  $price  Preis (optional)
     * @param  null|string  $validFrom  Gültig ab (optional)
     */
    public function __construct(
        protected int $pricechangeId,
        protected ?int $name = null,
        protected ?Group $group = null,
        protected ?Products $product = null,
        protected ?string $variant = null,
        protected float|int|null $price = null,
        protected ?string $validFrom = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'pricechangeID' => $this->pricechangeId,
            'name' => $this->name,
            'group' => $this->group?->value,
            'product' => $this->product?->value,
            'variant' => $this->variant,
            'price' => $this->price,
            'validFrom' => $this->validFrom,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/updatePricelistPricechange';
    }
}
