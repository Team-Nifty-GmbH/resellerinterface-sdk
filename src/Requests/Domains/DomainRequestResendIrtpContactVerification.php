<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_requestResendIrtpContactVerification
 *
 * Verschickt eine IRTP-Kontakt-Validierung erneut<br /><br />Benötigte Rechte:<br />**Domains
 * bestellen** (api.domain.order)<br /><br /><a target="_blank"
 * href="/core/api#domain/requestResendIrtpContactVerification">In Reseller-Interface öffnen</a>
 */
class DomainRequestResendIrtpContactVerification extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     */
    public function __construct(
        protected int $domain,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/requestResendIrtpContactVerification';
    }
}
