<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domainContent_delete
 *
 * Löscht Content von einer Domain<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR) verwalten**
 * (api.dns.manageRecords)<br /><br /><a target="_blank" href="/core/api#domainContent/delete">In
 * Reseller-Interface öffnen</a>
 */
class DomainContentDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     */
    public function __construct(
        protected int $domain,
        protected string $type,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'type' => $this->type]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainContent/delete';
    }
}
