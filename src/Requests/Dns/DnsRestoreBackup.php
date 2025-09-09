<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_restoreBackup
 *
 * Stellt eine Zone anhand eines Zonen-Backups wieder her<br /><br />Benötigte Rechte:<br
 * />**Zonenkopf (SOA) verwalten** (api.dns.manageSOA)<br /><br /><a target="_blank"
 * href="/core/api#dns/restoreBackup">In Reseller-Interface öffnen</a>
 */
class DnsRestoreBackup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $backupId  Zonen-Backup-ID
     */
    public function __construct(
        protected int $backupId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['backupID' => $this->backupId]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/restoreBackup';
    }
}
