<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;
use TeamNiftyGmbH\ResellerInterface\Enums\RenewalMode;

/**
 * post_tls_setRenewalMode
 *
 * Ändert den Verlängerungsmodus eines SSL-Zertifikats<br /><br />Benötigte Rechte:<br
 * />**SSL-Zertifikat-Verlängerungsmodus ändern** (api.tls.renewalMode)<br /><br /><a target="_blank"
 * href="/core/api#tls/setRenewalMode">In Reseller-Interface öffnen</a>
 */
class TlsSetRenewalMode extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  RenewalMode  $renewalMode  Verlängerungsmodus
     */
    public function __construct(
        protected string $tls,
        protected RenewalMode $renewalMode,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls, 'renewalMode' => $this->renewalMode->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/setRenewalMode';
    }
}
