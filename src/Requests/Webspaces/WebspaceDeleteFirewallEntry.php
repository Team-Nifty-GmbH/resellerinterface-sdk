<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_deleteFirewallEntry
 *
 * Löscht eine Firewall-Freigabe für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/deleteFirewallEntry">In Reseller-Interface öffnen</a>
 */
class WebspaceDeleteFirewallEntry extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspaceFirewallEntryId  ID des Firewall-Eintrags (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200" (optional)
     */
    public function __construct(
        protected ?int $webspaceFirewallEntryId = null,
        protected ?int $webspace = null,
        protected ?string $ip = null,
        protected ?string $port = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspaceFirewallEntryID' => $this->webspaceFirewallEntryId,
            'webspace' => $this->webspace,
            'ip' => $this->ip,
            'port' => $this->port,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/deleteFirewallEntry';
    }
}
