<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;
use TeamNiftyGmbH\ResellerInterface\Enums\DeleteMode;

/**
 * post_domain_setDeleteMode
 *
 * Ändert den Kündigungsmodus<br /><br />Benötigte Rechte:<br />**Domains kündigen**
 * (api.domain.delete)<br /><br /><a target="_blank" href="/core/api#domain/setDeleteMode">In
 * Reseller-Interface öffnen</a>
 */
class DomainSetDeleteMode extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  DeleteMode  $deleteMode  Löschmodus
     */
    public function __construct(
        protected int $domain,
        protected DeleteMode $deleteMode,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'deleteMode' => $this->deleteMode->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setDeleteMode';
    }
}
