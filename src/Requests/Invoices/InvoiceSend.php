<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Invoices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_invoice_send
 *
 * Verschickt eine Rechnung per E-Mail<br /><br />Benötigte Rechte:<br />**Finanzen verwalten**
 * (api.finance.manage)<br /><br /><a target="_blank" href="/core/api#invoice/send">In
 * Reseller-Interface öffnen</a>
 */
class InvoiceSend extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $invoiceId  Rechnungs-ID
     */
    public function __construct(
        protected int $invoiceId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['invoiceID' => $this->invoiceId]);
    }

    public function resolveEndpoint(): string
    {
        return '/invoice/send';
    }
}
