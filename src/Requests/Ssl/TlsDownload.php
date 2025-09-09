<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_tls_download
 *
 * Ein SSL-Zertifikat herunterladen<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate verwalten**
 * (api.tls.manage)<br /><br /><a target="_blank" href="/core/api#tls/download">In Reseller-Interface
 * öffnen</a>
 */
class TlsDownload extends Request implements HasBody
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
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/download';
    }
}
