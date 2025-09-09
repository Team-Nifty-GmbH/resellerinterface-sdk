<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_setHandles
 *
 * Merkt neue Kontakte für eine Domain vor. Zur Durchführung der Änderung muss noch
 * [domain/update](#post-/domain/update) ausgeführt werden.<br /><br />Benötigte Rechte:<br
 * />**Domains verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domain/setHandles">In Reseller-Interface öffnen</a>
 */
class DomainSetHandles extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     */
    public function __construct(
        protected int $domain,
        protected array $handles,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'handles' => $this->handles]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setHandles';
    }
}
