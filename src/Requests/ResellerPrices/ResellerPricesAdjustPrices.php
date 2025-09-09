<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Group;
use TeamNiftyGmbH\ResellerInterface\Enums\Mode;
use TeamNiftyGmbH\ResellerInterface\Enums\Products;
use TeamNiftyGmbH\ResellerInterface\Enums\Round;

/**
 * post_resellerPrices_adjustPrices
 *
 * Aktualisiert alle Preise einer Preisliste<br /><br />Benötigte Rechte:<br
 * />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/adjustPrices">In Reseller-Interface öffnen</a>
 */
class ResellerPricesAdjustPrices extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  Group  $group  Produkt-Gruppe
     * @param  Products  $products  Produkt-Namen
     * @param  null|bool  $active  Aktive oder Inaktive anpassen (optional)
     * @param  Mode  $mode  Modus
     *                      * `absolute` Absolute Preisanpassung
     *                      * `percentage` Prozentuale Preisanpassung
     * @param  float|int  $value  Wert der Preisänderung
     * @param  null|Round  $round  Anpassung der Preises
     *                             * `ninecent` Preis zu einem Gebrochenen Preis anpassen (x,x9 EUR)
     *                             * `integer` Preis auf ganzen EUR anpassen (optional)
     * @param  null|int  $roundVat  MwSt-Satz welcher für die Rundung verwendet werden soll (optional)
     */
    public function __construct(
        protected int $pricelistId,
        protected Group $group,
        protected Products $products,
        protected ?bool $active,
        protected Mode $mode,
        protected float|int $value,
        protected ?Round $round = null,
        protected ?int $roundVat = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'pricelistID' => $this->pricelistId,
            'group' => $this->group->value,
            'products' => $this->products->value,
            'active' => $this->active,
            'mode' => $this->mode->value,
            'value' => $this->value,
            'round' => $this->round?->value,
            'roundVat' => $this->roundVat,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/adjustPrices';
    }
}
