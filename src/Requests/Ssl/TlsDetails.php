<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_details
 *
 * Ruft die Informationen eines SSL-Zertifikates ab<br /><br />Benötigte Rechte:<br
 * />**SSL-Zertifikate einsehen** (api.tls.view)<br /><br /><a target="_blank"
 * href="/core/api#tls/details">In Reseller-Interface öffnen</a>
 */
class TlsDetails extends Request implements HasBody
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
        return '/tls/details';
    }
}
