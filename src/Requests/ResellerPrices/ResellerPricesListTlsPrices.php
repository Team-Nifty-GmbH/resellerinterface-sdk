<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_listTlsPrices
 *
 * Listet die TLSpreise einer Preisliste auf<br /><br />Benötigte Rechte:<br
 * />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/listTlsPrices">In Reseller-Interface öffnen</a>
 */
class ResellerPricesListTlsPrices extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pricelistId  Preislisten-ID
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     */
    public function __construct(
        protected int $pricelistId,
        protected ?bool $csv = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['pricelistID' => $this->pricelistId, 'csv' => $this->csv]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/listTlsPrices';
    }
}
