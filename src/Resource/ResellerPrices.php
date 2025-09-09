<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Group;
use TeamNiftyGmbH\ResellerInterface\Enums\Mode;
use TeamNiftyGmbH\ResellerInterface\Enums\Products;
use TeamNiftyGmbH\ResellerInterface\Enums\Round;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesAdjustPrices;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesClonePricelist;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesClonePricelistPricechange;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesCreatePayment;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesCreatePricelist;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesCreatePricelistPricechange;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesCreatePricelistPromotion;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesDeletePayment;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesDeletePricelist;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesDeletePricelistPricechange;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesDeletePricelistPromotion;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesDetailsPricelist;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesListDomainPrices;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesListPayments;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesListPricelistPricechanges;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesListPricelistPromotions;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesListPricelists;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesListTlsPrices;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesRefundPayPalPayment;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesSetPrices;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesUpdateOpenPaymentStatus;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesUpdatePricelist;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesUpdatePricelistPricechange;
use TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices\ResellerPricesUpdatePricelistPromotion;

class ResellerPrices extends BaseResource
{
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
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesAdjustPrices(
        int $pricelistId,
        Group $group,
        Products $products,
        ?bool $active,
        Mode $mode,
        float|int $value,
        ?Round $round = null,
        ?int $roundVat = null,
    ): Response {
        return $this->connector->send(new ResellerPricesAdjustPrices($pricelistId, $group, $products, $active, $mode, $value, $round, $roundVat));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|int  $name  Preislisten-Name (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesClonePricelist(int $pricelistId, ?int $name = null): Response
    {
        return $this->connector->send(new ResellerPricesClonePricelist($pricelistId, $name));
    }

    /**
     * @param  int  $pricechangeId  Preisänderung-ID
     * @param  null|int  $name  Preisänderung-Name (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesClonePricelistPricechange(int $pricechangeId, ?int $name = null): Response
    {
        return $this->connector->send(new ResellerPricesClonePricelistPricechange($pricechangeId, $name));
    }

    /**
     * @param  array  $resellerId  Reseller-ID
     * @param  string  $amount  Betrag
     * @param  string  $reference  Zusammenfassung
     * @param  null|string  $dateValuta  (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesCreatePayment(
        array $resellerId,
        string $amount,
        string $reference,
        ?string $dateValuta = null,
    ): Response {
        return $this->connector->send(new ResellerPricesCreatePayment($resellerId, $amount, $reference, $dateValuta));
    }

    /**
     * @param  int  $name  Preislisten-Name
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesCreatePricelist(int $name): Response
    {
        return $this->connector->send(new ResellerPricesCreatePricelist($name));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  int  $name  Preisänderung-Name
     * @param  Group  $group  Produkt-Gruppe
     * @param  Products  $product  Produkt-Name
     * @param  string  $variant  Produkt-Variante
     * @param  null|float|int  $price  Preis (optional)
     * @param  string  $validFrom  Gültig ab
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesCreatePricelistPricechange(
        int $pricelistId,
        int $name,
        Group $group,
        Products $product,
        string $variant,
        float|int|null $price = null,
        string $validFrom,
    ): Response {
        return $this->connector->send(new ResellerPricesCreatePricelistPricechange($pricelistId, $name, $group, $product, $variant, $price, $validFrom));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  int  $name  Promo-Name
     * @param  Group  $group  Produkt-Gruppe
     * @param  Products  $product  Produkt-Name
     * @param  string  $variant  Produkt-Variante
     * @param  null|float|int  $price  Preis (optional)
     * @param  string  $validFrom  Gültig von
     * @param  string  $validTo  Gültig bis
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesCreatePricelistPromotion(
        int $pricelistId,
        int $name,
        Group $group,
        Products $product,
        string $variant,
        float|int|null $price = null,
        string $validFrom,
        string $validTo,
    ): Response {
        return $this->connector->send(new ResellerPricesCreatePricelistPromotion($pricelistId, $name, $group, $product, $variant, $price, $validFrom, $validTo));
    }

    /**
     * @param  array  $paymentId  Zahlungs-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesDeletePayment(array $paymentId): Response
    {
        return $this->connector->send(new ResellerPricesDeletePayment($paymentId));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesDeletePricelist(int $pricelistId): Response
    {
        return $this->connector->send(new ResellerPricesDeletePricelist($pricelistId));
    }

    /**
     * @param  int  $pricechangeId  Preisänderung-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesDeletePricelistPricechange(int $pricechangeId): Response
    {
        return $this->connector->send(new ResellerPricesDeletePricelistPricechange($pricechangeId));
    }

    /**
     * @param  int  $promotionId  Promo-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesDeletePricelistPromotion(int $promotionId): Response
    {
        return $this->connector->send(new ResellerPricesDeletePricelistPromotion($promotionId));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesDetailsPricelist(int $pricelistId): Response
    {
        return $this->connector->send(new ResellerPricesDetailsPricelist($pricelistId));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|array  $category  TLD-Kategorie (optional)
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesListDomainPrices(
        int $pricelistId,
        ?array $category = null,
        ?bool $csv = null,
    ): Response {
        return $this->connector->send(new ResellerPricesListDomainPrices($pricelistId, $category, $csv));
    }

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesListPayments(
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new ResellerPricesListPayments($search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesListPricelistPricechanges(
        int $pricelistId,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new ResellerPricesListPricelistPricechanges($pricelistId, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesListPricelistPromotions(
        int $pricelistId,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new ResellerPricesListPricelistPromotions($pricelistId, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesListPricelists(
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new ResellerPricesListPricelists($search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesListTlsPrices(int $pricelistId, ?bool $csv = null): Response
    {
        return $this->connector->send(new ResellerPricesListTlsPrices($pricelistId, $csv));
    }

    /**
     * @param  array  $paymentId  Zahlungs-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesRefundPayPalPayment(array $paymentId): Response
    {
        return $this->connector->send(new ResellerPricesRefundPayPalPayment($paymentId));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|array  $products  Produkte (optional)
     * @param  null|array  $prices  Produktpreise (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesSetPrices(int $pricelistId, ?array $products = null, ?array $prices = null): Response
    {
        return $this->connector->send(new ResellerPricesSetPrices($pricelistId, $products, $prices));
    }

    /**
     * @param  array  $paymentId  Zahlungs-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesUpdateOpenPaymentStatus(array $paymentId): Response
    {
        return $this->connector->send(new ResellerPricesUpdateOpenPaymentStatus($paymentId));
    }

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  int  $name  Preislisten-Name
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesUpdatePricelist(int $pricelistId, int $name): Response
    {
        return $this->connector->send(new ResellerPricesUpdatePricelist($pricelistId, $name));
    }

    /**
     * @param  int  $pricechangeId  Preisänderung-ID
     * @param  null|int  $name  Preisänderung-Name (optional)
     * @param  null|Group  $group  Produkt-Gruppe (optional)
     * @param  null|Products  $product  Produkt-Name (optional)
     * @param  null|string  $variant  Produkt-Variante (optional)
     * @param  null|float|int  $price  Preis (optional)
     * @param  null|string  $validFrom  Gültig ab (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesUpdatePricelistPricechange(
        int $pricechangeId,
        ?int $name = null,
        ?Group $group = null,
        ?Products $product = null,
        ?string $variant = null,
        float|int|null $price = null,
        ?string $validFrom = null,
    ): Response {
        return $this->connector->send(new ResellerPricesUpdatePricelistPricechange($pricechangeId, $name, $group, $product, $variant, $price, $validFrom));
    }

    /**
     * @param  int  $promotionId  Promo-ID
     * @param  null|int  $name  Promo-Name (optional)
     * @param  null|Group  $group  Produkt-Gruppe (optional)
     * @param  null|Products  $product  Produkt-Name (optional)
     * @param  null|string  $variant  Produkt-Variante (optional)
     * @param  null|float|int  $price  Preis (optional)
     * @param  null|string  $validFrom  Gültig von (optional)
     * @param  null|string  $validTo  Gültig bis (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPricesUpdatePricelistPromotion(
        int $promotionId,
        ?int $name = null,
        ?Group $group = null,
        ?Products $product = null,
        ?string $variant = null,
        float|int|null $price = null,
        ?string $validFrom = null,
        ?string $validTo = null,
    ): Response {
        return $this->connector->send(new ResellerPricesUpdatePricelistPromotion($promotionId, $name, $group, $product, $variant, $price, $validFrom, $validTo));
    }
}
