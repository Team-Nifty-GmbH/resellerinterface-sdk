<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\PushRequest;

/**
 * post_domain_detailsPushRequest
 *
 * Ruft Informationen zu einen bestehenden Domain-Push ab<br /><br />Benötigte Rechte:<br />**Domains
 * einsehen** (api.domain.view)<br /><br /><a target="_blank"
 * href="/core/api#domain/detailsPushRequest">In Reseller-Interface öffnen</a>
 */
class DomainDetailsPushRequest extends Request implements HasBody
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
        return PushRequest::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['pushRequestID' => $this->pushRequestId]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/detailsPushRequest';
    }
}
