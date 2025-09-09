<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteBackup
 *
 * <br /><br />Benötigte Rechte:<br />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a
 * target="_blank" href="/core/api#webspace/deleteBackup">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteBackup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     */
    public function __construct(
        protected int $webspace,
        protected int $webspaceBackupId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'webspaceBackupID' => $this->webspaceBackupId]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteBackup';
    }
}
