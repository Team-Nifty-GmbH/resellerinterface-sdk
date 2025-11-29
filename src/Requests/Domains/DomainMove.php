<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Contracts\SkipsResellerIdInjection;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_domain_move
 *
 * Verschiebt eine Domain<br /><br />Benötigte Rechte:<br />**Domains bestellen**
 * (api.domain.order)<br />**Unterreseller verwalten** (api.reseller.manage)<br /><br /><a
 * target="_blank" href="/core/api#domain/move">In Reseller-Interface öffnen</a>
 */
class DomainMove extends Request implements HasBody, SkipsResellerIdInjection
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int|string  $domain  Domain-ID oder Domainname
     * @param  int  $targetResellerId  Reseller-ID des Zielaccounts
     * @param  null|bool  $cloneHandles  Handles kopieren (optional)
     */
    public function __construct(
        protected int|string $domain,
        protected int $targetResellerId,
        protected ?bool $cloneHandles = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'targetResellerID' => $this->targetResellerId, 'cloneHandles' => $this->cloneHandles]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/move';
    }
}
