<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_uncancel
 *
 * Widerruft die Kündigung eines SSL-Zertifikats<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate
 * bestellen** (api.tls.order)<br /><br /><a target="_blank" href="/core/api#tls/uncancel">In
 * Reseller-Interface öffnen</a>
 */
class TlsUncancel extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     */
    public function __construct(
        protected string $tls,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/uncancel';
    }
}
