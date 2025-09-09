<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_webspace_restoreBackup
 *
 * Wiederherstellung eines Backups für ein Websapce<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/restoreBackup">In Reseller-Interface öffnen</a>
 */
class WebspaceRestoreBackup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  Type  $type  Webspace-Bereiche für das Backup
     * @param  null|array  $databases  (optional)
     * @param  null|array  $inboxes  (optional)
     */
    public function __construct(
        protected int $webspace,
        protected int $webspaceBackupId,
        protected Type $type,
        protected ?array $databases = null,
        protected ?array $inboxes = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'webspaceBackupID' => $this->webspaceBackupId,
            'type' => $this->type->value,
            'databases' => $this->databases,
            'inboxes' => $this->inboxes,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/restoreBackup';
    }
}
