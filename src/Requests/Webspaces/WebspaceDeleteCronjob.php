<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteCronjob
 *
 * Löscht einen Cronjob für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/deleteCronjob">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteCronjob extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceCronjobId  ID des Cronjobs
     */
    public function __construct(
        protected int $webspaceCronjobId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspaceCronjobID' => $this->webspaceCronjobId]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteCronjob';
    }
}
