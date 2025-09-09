<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_getBackup
 *
 * Ruft die Informationen eines Webspace-Backups ab<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/getBackup">In Reseller-Interface öffnen</a>
 */
class WebspaceGetBackup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $webspace  ID oder Name des Webspaces (optional)
     * @param  null|bool  $force  Erzwingen (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     */
    public function __construct(
        protected ?int $webspace = null,
        protected ?bool $force = null,
        protected ?bool $waitForResponse = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'force' => $this->force, 'waitForResponse' => $this->waitForResponse]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/getBackup';
    }
}
