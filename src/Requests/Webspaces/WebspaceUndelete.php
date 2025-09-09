<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Webspace;

/**
 * post_webspace_undelete
 *
 * Widerruft die Kündigung eines Webspaces<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * kündigen** (api.webspace.delete)<br /><br /><a target="_blank"
 * href="/core/api#webspace/undelete">In Reseller-Interface öffnen</a>
 */
class WebspaceUndelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     */
    public function __construct(
        protected int $webspace,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Webspace::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/undelete';
    }
}
