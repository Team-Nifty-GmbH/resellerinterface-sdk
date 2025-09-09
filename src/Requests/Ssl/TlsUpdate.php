<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_update
 *
 * Aktualisiert die Informationen eines SSL-Zertifikats<br /><br />Benötigte Rechte:<br
 * />**SSL-Zertifikate verwalten** (api.tls.manage)<br /><br /><a target="_blank"
 * href="/core/api#tls/update">In Reseller-Interface öffnen</a>
 */
class TlsUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|string  $tag  Tag (optional)
     * @param  null|string  $comment  Kommentar (optional)
     */
    public function __construct(
        protected string $tls,
        protected ?string $tag = null,
        protected ?string $comment = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['tls' => $this->tls, 'tag' => $this->tag, 'comment' => $this->comment]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/update';
    }
}
