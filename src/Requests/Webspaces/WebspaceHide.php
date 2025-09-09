<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_hide
 *
 * Blendet ein gelöschtes Webspace-Paket aus<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank" href="/core/api#webspace/hide">In
 * Reseller-Interface öffnen</a>
 */
class WebspaceHide extends Request implements HasBody
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
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/hide';
    }
}
