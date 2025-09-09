<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_updateOpenPaymentStatus
 *
 * <br /><br />Benötigte Rechte:<br />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a
 * target="_blank" href="/core/api#resellerPrices/updateOpenPaymentStatus">In Reseller-Interface
 * öffnen</a>
 */
class ResellerPricesUpdateOpenPaymentStatus extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  array  $paymentId  Zahlungs-ID
     */
    public function __construct(
        protected array $paymentId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['paymentID' => $this->paymentId]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/updateOpenPaymentStatus';
    }
}
