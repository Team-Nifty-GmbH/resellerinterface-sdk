<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_renew
 *
 * Verlängert ein SSL-Zertifikat<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate bestellen**
 * (api.tls.order)<br /><br /><a target="_blank" href="/core/api#tls/renew">In Reseller-Interface
 * öffnen</a>
 */
class TlsRenew extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     */
    public function __construct(
        protected string $tls,
        protected ?int $paymentRuntime = null,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls, 'paymentRuntime' => $this->paymentRuntime, 'fullyAsync' => $this->fullyAsync]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/renew';
    }
}
