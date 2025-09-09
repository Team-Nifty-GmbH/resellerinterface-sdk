<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Order;

/**
 * post_domain_restore
 *
 * Stellt eine gelöschte Domain wieder her<br /><br />Benötigte Rechte:<br />**Domains bestellen**
 * (api.domain.order)<br /><br /><a target="_blank" href="/core/api#domain/restore">In
 * Reseller-Interface öffnen</a>
 */
class DomainRestore extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?int $runtime = null,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Order::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'runtime' => $this->runtime, 'fullyAsync' => $this->fullyAsync]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/restore';
    }
}
