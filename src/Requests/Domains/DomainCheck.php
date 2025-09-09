<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_check
 *
 * Prüft die Verfügbarkeit von Domainnamen<br /><br />Benötigte Rechte:<br />**Domainverfügbarkeit
 * abfragen** (api.domain.check)<br /><br /><a target="_blank" href="/core/api#domain/check">In
 * Reseller-Interface öffnen</a>
 */
class DomainCheck extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  array  $domain  Liste an Domains
     */
    public function __construct(
        protected array $domain,
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
        return '/domain/check';
    }
}
