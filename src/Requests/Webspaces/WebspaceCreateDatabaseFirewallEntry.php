<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_createDatabaseFirewallEntry
 *
 * Erstellt eine Firewall-Freigabe für eine Webspace-Datenbank<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createDatabaseFirewallEntry">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateDatabaseFirewallEntry extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $ip  IP-Adresse (optional)
     * @param  null|string  $comment  Kommentar (optional)
     */
    public function __construct(
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
        return array_filter(['webspace' => $this->webspace, 'ip' => $this->ip, 'comment' => $this->comment]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createDatabaseFirewallEntry';
    }
}
