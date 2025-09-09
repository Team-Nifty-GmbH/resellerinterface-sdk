<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_setStatus
 *
 * Ändert die Status einer Domain ab<br /><br />Benötigte Rechte:<br />**Domains verwalten**
 * (api.domain.manage)<br /><br /><a target="_blank" href="/core/api#domain/setStatus">In
 * Reseller-Interface öffnen</a>
 */
class DomainSetStatus extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|bool  $transferLock  Transfersperre de-/aktivieren (optional)
     * @param  null|bool  $updateLock  Updatesperre de-/aktivieren (optional)
     * @param  null|bool  $deleteLock  Löschsperre de-/aktivieren (optional)
     * @param  null|bool  $clientHold  Auflösungssperre de-/aktivieren (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?bool $transferLock = null,
        protected ?bool $updateLock = null,
        protected ?bool $deleteLock = null,
        protected ?bool $clientHold = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'transferLock' => $this->transferLock,
            'updateLock' => $this->updateLock,
            'deleteLock' => $this->deleteLock,
            'clientHold' => $this->clientHold,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setStatus';
    }
}
