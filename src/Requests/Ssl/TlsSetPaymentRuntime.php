<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_setPaymentRuntime
 *
 * Ändert die Zahlungslaufzeit eines SSL-Zertifikats<br /><br />Benötigte Rechte:<br
 * />**SSL-Zertifikate bestellen** (api.tls.order)<br /><br /><a target="_blank"
 * href="/core/api#tls/setPaymentRuntime">In Reseller-Interface öffnen</a>
 */
class TlsSetPaymentRuntime extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|bool  $forNextContractPeriod  Zahlungsintervall erst bei der nächsten Vertragsverlängerung anpassen anstatt zum nächstmöglichen Zeitpunkt (optional)
     */
    public function __construct(
        protected string $tls,
        protected ?int $paymentRuntime = null,
        protected ?bool $forNextContractPeriod = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'tls' => $this->tls,
            'paymentRuntime' => $this->paymentRuntime,
            'forNextContractPeriod' => $this->forNextContractPeriod,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/setPaymentRuntime';
    }
}
