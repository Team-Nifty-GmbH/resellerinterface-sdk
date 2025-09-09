<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domainContent_getConflicts
 *
 * Fragt ab ob es DNS-Konflikte in einer Zone gibt<br /><br />Benötigte Rechte:<br />**Zonenrecords
 * (RR) verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#domainContent/getConflicts">In Reseller-Interface öffnen</a>
 */
class DomainContentGetConflicts extends Request implements HasBody
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
        return '/domainContent/getConflicts';
    }
}
