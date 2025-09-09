<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Payments;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_payment_balance
 *
 * Ruft Informationen über das Guthaben eines Kunden ab<br /><br />Benötigte Rechte:<br />**Finanzen
 * einsehen** (api.finance.view)<br /><br /><a target="_blank" href="/core/api#payment/balance">In
 * Reseller-Interface öffnen</a>
 */
class PaymentBalance extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/payment/balance';
    }
}
