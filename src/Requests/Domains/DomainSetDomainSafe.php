<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_setDomainSafe
 *
 * Einstellungen des Domain-Safe für eine Domain setzen<br /><br />Benötigte Rechte:<br
 * />**Domain-Safe verwalten** (api.domain.domainSafe)<br /><br /><a target="_blank"
 * href="/core/api#domain/setDomainSafe">In Reseller-Interface öffnen</a>
 */
class DomainSetDomainSafe extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $lockUpdate  Domainupdates verbieten
     * @param  bool  $lockTransfer  Domaintransfers verbieten
     * @param  bool  $lockCancellation  Domainkündigung verbieten
     */
    public function __construct(
        protected int $domain,
        protected bool $lockUpdate,
        protected bool $lockTransfer,
        protected bool $lockCancellation,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'lockUpdate' => $this->lockUpdate,
            'lockTransfer' => $this->lockTransfer,
            'lockCancellation' => $this->lockCancellation,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setDomainSafe';
    }
}
