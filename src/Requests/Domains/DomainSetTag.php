<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_domain_setTag
 *
 * Ändern des Domain-Tags<br /><br />Benötigte Rechte:<br />**Domains verwalten**
 * (api.domain.manage)<br /><br /><a target="_blank" href="/core/api#domain/setTag">In
 * Reseller-Interface öffnen</a>
 */
class DomainSetTag extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|string  $tag  Tag (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?string $tag = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'tag' => $this->tag]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setTag';
    }
}
