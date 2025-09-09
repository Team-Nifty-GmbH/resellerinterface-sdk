<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Invoices\InvoiceDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Invoices\InvoiceList;
use TeamNiftyGmbH\ResellerInterface\Requests\Invoices\InvoiceListItems;
use TeamNiftyGmbH\ResellerInterface\Requests\Invoices\InvoiceSend;

class Invoices extends BaseResource
{
    /**
     * @param  int  $invoiceId  Rechnungs-ID
     * @param  null|bool  $withBalance  Zahlungsverlauf mit abrufen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function invoiceDetails(int $invoiceId, ?bool $withBalance = null): Response
    {
        return $this->connector->send(new InvoiceDetails($invoiceId, $withBalance));
    }

    /**
     * @param  null|bool  $withItems  Rechnungsposten mit abrufen (optional)
     * @param  null|bool  $withBalance  Zahlungsverlauf mit abrufen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function invoiceList(
        ?bool $withItems = null,
        ?bool $withBalance = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new InvoiceList($withItems, $withBalance, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function invoiceListItems(
        ?bool $csv = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new InvoiceListItems($csv, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $invoiceId  Rechnungs-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function invoiceSend(int $invoiceId): Response
    {
        return $this->connector->send(new InvoiceSend($invoiceId));
    }
}
