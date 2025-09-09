<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\PushRequest;

/**
 * post_domain_initiatePushRequest
 *
 * Leitet einen Domain-Push-Auftrag ein<br /><br />Benötigte Rechte:<br />**Domains kündigen**
 * (api.domain.delete)<br />**Domains pushen** (api.domain.push)<br /><br /><a target="_blank"
 * href="/core/api#domain/initiatePushRequest">In Reseller-Interface öffnen</a>
 */
class DomainInitiatePushRequest extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  array  $domain  Domainname (sld.tld)
     * @param  int  $targetResellerId  Reseller-ID des Zielaccounts
     * @param  null|bool  $cloneSettings  Einstellungen mit kopieren (optional)
     * @param  null|bool  $cloneHandles  Handles kopieren (optional)
     */
    public function __construct(
        protected array $domain,
        protected int $targetResellerId,
        protected ?bool $cloneSettings = null,
        protected ?bool $cloneHandles = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return PushRequest::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'targetResellerID' => $this->targetResellerId,
            'cloneSettings' => $this->cloneSettings,
            'cloneHandles' => $this->cloneHandles,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/initiatePushRequest';
    }
}
