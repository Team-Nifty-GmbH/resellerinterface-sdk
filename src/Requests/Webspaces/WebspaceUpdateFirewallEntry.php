<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_updateFirewallEntry
 *
 * Aktualisiert die Informationen für eine Firewall-Freigabe<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/updateFirewallEntry">In Reseller-Interface öffnen</a>
 */
class WebspaceUpdateFirewallEntry extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspaceFirewallEntryId  ID des Firewall-Eintrags (optional)
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200" (optional)
     * @param  string  $comment  Kommentar
     */
    public function __construct(
        protected ?int $webspaceFirewallEntryId,
        protected ?int $webspace,
        protected ?string $ip,
        protected ?string $port,
        protected string $comment,
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
            'comment' => $this->comment,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/updateFirewallEntry';
    }
}
