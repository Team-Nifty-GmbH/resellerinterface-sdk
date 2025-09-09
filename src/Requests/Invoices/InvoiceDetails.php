<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Invoices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Invoice;

/**
 * post_invoice_details
 *
 * Ruft die Informationen zu einer Rechnung ab<br /><br />Benötigte Rechte:<br />**Finanzen einsehen**
 * (api.finance.view)<br /><br /><a target="_blank" href="/core/api#invoice/details">In
 * Reseller-Interface öffnen</a>
 */
class InvoiceDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $invoiceId  Rechnungs-ID
     * @param  null|bool  $withBalance  Zahlungsverlauf mit abrufen (optional)
     */
    public function __construct(
        protected int $invoiceId,
        protected ?bool $withBalance = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Invoice::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['invoiceID' => $this->invoiceId, 'withBalance' => $this->withBalance]);
    }

    public function resolveEndpoint(): string
    {
        return '/invoice/details';
    }
}
