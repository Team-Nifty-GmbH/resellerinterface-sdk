<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteDomain
 *
 * Löscht eine Domain für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/deleteDomain">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteDomain extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceDomainId  ID der Webspace-Domain
     */
    public function __construct(
        protected int $webspaceDomainId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceDomainID' => $this->webspaceDomainId]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteDomain';
    }
}
