<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Order;

/**
 * post_domain_trade
 *
 * Leitet einen Inhaberwechsel ein<br /><br />Benötigte Rechte:<br />**Domains verwalten**
 * (api.domain.manage)<br /><br /><a target="_blank" href="/core/api#domain/trade">In
 * Reseller-Interface öffnen</a>
 */
class DomainTrade extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|string  $owner  Owner-Handle (optional) [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?string $owner = null,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Order::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'owner' => $this->owner, 'fullyAsync' => $this->fullyAsync]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/trade';
    }
}
