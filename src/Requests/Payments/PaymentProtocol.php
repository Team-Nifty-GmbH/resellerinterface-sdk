<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Payments;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_payment_protocol
 *
 * Ruft das Zahlungsprotokoll für ein Jahr ab<br /><br />Benötigte Rechte:<br />**Finanzen einsehen**
 * (api.finance.view)<br /><br /><a target="_blank" href="/core/api#payment/protocol">In
 * Reseller-Interface öffnen</a>
 */
class PaymentProtocol extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $year  Zahlungs-ID (optional)
     */
    public function __construct(
        protected ?int $year = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['year' => $this->year]);
    }

    public function resolveEndpoint(): string
    {
        return '/payment/protocol';
    }
}
