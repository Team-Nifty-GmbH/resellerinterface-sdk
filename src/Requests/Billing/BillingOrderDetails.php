<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Billing;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Order;

/**
 * post_billing_orderDetails
 *
 * Ruft Informationen zu einer Bestellung ab<br /><br />Benötigte Rechte:<br />**Finanzen einsehen**
 * (api.finance.view)<br /><br /><a target="_blank" href="/core/api#billing/orderDetails">In
 * Reseller-Interface öffnen</a>
 */
class BillingOrderDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $orderId  Bestell-ID
     */
    public function __construct(
        protected int $orderId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Order::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['orderID' => $this->orderId]);
    }

    public function resolveEndpoint(): string
    {
        return '/billing/orderDetails';
    }
}
