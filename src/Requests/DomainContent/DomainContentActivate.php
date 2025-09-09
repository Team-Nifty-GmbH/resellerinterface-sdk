<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domainContent_activate
 *
 * Aktiviert Content auf einer Domain<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR)
 * verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#domainContent/activate">In Reseller-Interface öffnen</a>
 */
class DomainContentActivate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  null|bool  $force  Aktivierung erzwingen (optional)
     */
    public function __construct(
        protected int $domain,
        protected string $type,
        protected ?bool $force = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'type' => $this->type, 'force' => $this->force]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainContent/activate';
    }
}
