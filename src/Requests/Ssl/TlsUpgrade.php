<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_upgrade
 *
 * Wertet ein SSL-Zertifikat auf<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate verwalten**
 * (api.tls.manage)<br /><br /><a target="_blank" href="/core/api#tls/upgrade">In Reseller-Interface
 * öffnen</a>
 */
class TlsUpgrade extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  string  $product  TLS-Produkt
     * @param  null|string  $reason  Grund der Aufwertung (optional)
     */
    public function __construct(
        protected string $tls,
        protected string $product,
        protected ?string $reason = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls, 'product' => $this->product, 'reason' => $this->reason]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/upgrade';
    }
}
