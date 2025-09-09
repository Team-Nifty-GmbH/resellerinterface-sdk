<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\State;

/**
 * post_domain_answerTransferRequest
 *
 * Beantwortet eine Transfer-Anfrage<br /><br />Benötigte Rechte:<br />**Domains kündigen**
 * (api.domain.delete)<br /><br /><a target="_blank" href="/core/api#domain/answerTransferRequest">In
 * Reseller-Interface öffnen</a>
 */
class DomainAnswerTransferRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  int  $transferRequestId  Transfer-Anfrage-ID
     * @param  State  $state  Statuscode
     */
    public function __construct(
        protected int $domain,
        protected int $transferRequestId,
        protected State $state,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'transferRequestID' => $this->transferRequestId, 'state' => $this->state->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/answerTransferRequest';
    }
}
