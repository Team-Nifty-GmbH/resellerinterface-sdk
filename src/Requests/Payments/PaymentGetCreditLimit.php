<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Payments;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_payment_getCreditLimit
 *
 * Ruft das Kreditlimit eines Kunden ab<br /><br />Benötigte Rechte:<br />**Finanzen einsehen**
 * (api.finance.view)<br /><br /><a target="_blank" href="/core/api#payment/getCreditLimit">In
 * Reseller-Interface öffnen</a>
 */
class PaymentGetCreditLimit extends Request implements HasBody
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
        return '/payment/getCreditLimit';
    }
}
