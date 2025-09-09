<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_executePushRequest
 *
 * Führt einen bestehenden Domain-Push-Auftrag aus<br /><br />Benötigte Rechte:<br />**Domains
 * bestellen** (api.domain.order)<br /><br /><a target="_blank"
 * href="/core/api#domain/executePushRequest">In Reseller-Interface öffnen</a>
 */
class DomainExecutePushRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     * @param  string  $password  Passwort des Domain-Push-Auftrags
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     */
    public function __construct(
        protected int $pushRequestId,
        protected string $password,
        protected bool $revocationAccepted,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'pushRequestID' => $this->pushRequestId,
            'password' => $this->password,
            'revocationAccepted' => $this->revocationAccepted,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/executePushRequest';
    }
}
