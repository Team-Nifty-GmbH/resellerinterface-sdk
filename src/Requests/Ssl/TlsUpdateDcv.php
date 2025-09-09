<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_tls_updateDCV
 *
 * Ändert die Validierungsart eines SSL-Zertifikats<br /><br />Benötigte Rechte:<br
 * />**SSL-Zertifikate verwalten** (api.tls.manage)<br /><br /><a target="_blank"
 * href="/core/api#tls/updateDCV">In Reseller-Interface öffnen</a>
 */
class TlsUpdateDcv extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  Type  $type  DCV-Modus
     * @param  null|string  $email  Bestätigungs-E-Mail-Adresse (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     */
    public function __construct(
        protected string $tls,
        protected Type $type,
        protected ?string $email = null,
        protected ?bool $waitForResponse = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'tls' => $this->tls,
            'type' => $this->type->value,
            'email' => $this->email,
            'waitForResponse' => $this->waitForResponse,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/updateDCV';
    }
}
