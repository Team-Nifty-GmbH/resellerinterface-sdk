<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_cancel
 *
 * Kündigt ein SSL-Zertifikat<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate bestellen**
 * (api.tls.order)<br /><br /><a target="_blank" href="/core/api#tls/cancel">In Reseller-Interface
 * öffnen</a>
 */
class TlsCancel extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|string  $reason  Grund der Kündigung (optional)
     */
    public function __construct(
        protected string $tls,
        protected ?string $reason = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls, 'reason' => $this->reason]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/cancel';
    }
}
