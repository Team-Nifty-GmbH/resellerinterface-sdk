<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_updateDatabaseFirewallEntry
 *
 * Aktualisiert die Informationen für eine Datenbank-Firewall-Freigabe<br /><br />Benötigte
 * Rechte:<br />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/updateDatabaseFirewallEntry">In Reseller-Interface öffnen</a>
 */
class WebspaceUpdateDatabaseFirewallEntry extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceDatabaseFirewallEntryId  ID des Datenbank-Firewall-Eintrags
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $comment  Kommentar (optional)
     */
    public function __construct(
        protected int $webspaceDatabaseFirewallEntryId,
        protected int $webspace,
        protected ?string $ip = null,
        protected ?string $comment = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspaceDatabaseFirewallEntryID' => $this->webspaceDatabaseFirewallEntryId,
            'webspace' => $this->webspace,
            'ip' => $this->ip,
            'comment' => $this->comment,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/updateDatabaseFirewallEntry';
    }
}
