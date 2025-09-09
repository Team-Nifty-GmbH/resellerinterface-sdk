<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\SelectedInterval;

/**
 * post_webspace_createCronjob
 *
 * Erstellt einen Cronjob für eine Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/createCronjob">In Reseller-Interface öffnen</a>
 */
class WebspaceCreateCronjob extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $name  Cronjob-Name
     * @param  string  $url  Aufzurufende URL
     * @param  SelectedInterval  $selectedInterval  Aktivierungsintervall des Cronjobs
     * @param  null|string  $cronInterval  Benutzerdefiniertes Aktivierungsintervall (optional)
     */
    public function __construct(
        protected int $webspace,
        protected string $name,
        protected string $url,
        protected SelectedInterval $selectedInterval,
        protected ?string $cronInterval = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'name' => $this->name,
            'url' => $this->url,
            'selectedInterval' => $this->selectedInterval->value,
            'cronInterval' => $this->cronInterval,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/createCronjob';
    }
}
