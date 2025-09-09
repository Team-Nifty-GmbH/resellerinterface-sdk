<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_activateFirewallLogging
 *
 * Aktiviert das Logging der Firewall<br /><br />Benötigte Rechte:<br />**Webspacepakete verwalten**
 * (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/activateFirewallLogging">In Reseller-Interface öffnen</a>
 */
class WebspaceActivateFirewallLogging extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $duration  Dauer des Loggings in Minuten
     */
    public function __construct(
        protected int $webspace,
        protected int $duration,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'duration' => $this->duration]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/activateFirewallLogging';
    }
}
