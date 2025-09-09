<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_setPaymentRuntime
 *
 * Ändert die Zahlungslaufzeit für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/setPaymentRuntime">In Reseller-Interface öffnen</a>
 */
class WebspaceSetPaymentRuntime extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $paymentRuntime  Zahlungsinterval in Monaten
     * @param  null|bool  $forNextContractPeriod  Zahlungsintervall erst bei der nächsten Vertragsverlängerung anpassen anstatt zum nächstmöglichen Zeitpunkt (optional)
     */
    public function __construct(
        protected int $webspace,
        protected int $paymentRuntime,
        protected ?bool $forNextContractPeriod = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'paymentRuntime' => $this->paymentRuntime,
            'forNextContractPeriod' => $this->forNextContractPeriod,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/setPaymentRuntime';
    }
}
