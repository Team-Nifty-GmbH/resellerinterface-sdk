<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_deletePushRequest
 *
 * Löscht einen bestehenden Domain-Push-Auftrag<br /><br />Benötigte Rechte:<br />**Domains
 * kündigen** (api.domain.delete)<br />**Domains pushen** (api.domain.push)<br /><br /><a
 * target="_blank" href="/core/api#domain/deletePushRequest">In Reseller-Interface öffnen</a>
 */
class DomainDeletePushRequest extends Request implements HasBody
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
        return '/domain/deletePushRequest';
    }
}
