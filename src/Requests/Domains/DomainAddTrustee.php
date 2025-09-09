<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_addTrustee
 *
 * Fügt einer Domain einen Treuhändler hinzu<br /><br />Benötigte Rechte:<br />**Domains bestellen**
 * (api.domain.order)<br /><br /><a target="_blank" href="/core/api#domain/addTrustee">In
 * Reseller-Interface öffnen</a>
 */
class DomainAddTrustee extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $paymentAccepted  Hiermit bestätige ich die Kosten gemäß Preisliste.
     */
    public function __construct(
        protected int $domain,
        protected bool $paymentAccepted,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'paymentAccepted' => $this->paymentAccepted]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/addTrustee';
    }
}
