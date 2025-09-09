<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_createFirewallEntry
 *
 * Erstellt eine Firewall-Freigabe für ein Webspace<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createFirewallEntry">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateFirewallEntry extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  string  $port  Der oder die Freizugebene(n) Ports, z.B. "80", "80, 443", "10000-10200"
     * @param  string  $comment  Kommentar
     * @param  bool  $acceptRules  Firewall-Regeln akzeptiert
     */
    public function __construct(
        protected int $webspace,
        protected ?string $ip,
        protected string $port,
        protected string $comment,
        protected bool $acceptRules,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'ip' => $this->ip,
            'port' => $this->port,
            'comment' => $this->comment,
            'acceptRules' => $this->acceptRules,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createFirewallEntry';
    }
}
