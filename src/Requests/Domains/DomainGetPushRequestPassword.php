<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_getPushRequestPassword
 *
 * Ruft das Passwort zu einem Domain-Push-Auftrag ab<br /><br />Benötigte Rechte:<br />**Domains
 * kündigen** (api.domain.delete)<br /><br /><a target="_blank"
 * href="/core/api#domain/getPushRequestPassword">In Reseller-Interface öffnen</a>
 */
class DomainGetPushRequestPassword extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     */
    public function __construct(
        protected int $pushRequestId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['pushRequestID' => $this->pushRequestId]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/getPushRequestPassword';
    }
}
