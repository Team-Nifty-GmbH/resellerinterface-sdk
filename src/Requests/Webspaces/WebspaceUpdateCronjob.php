<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\SelectedInterval;

/**
 * post_webspace_updateCronjob
 *
 * Aktualisiert die Informationen für einen Cronjob<br /><br />Benötigte Rechte:<br
 * />**Webspacepakete verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/updateCronjob">In Reseller-Interface öffnen</a>
 */
class WebspaceUpdateCronjob extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspaceCronjobId  ID des Cronjobs
     * @param  null|bool  $active  Ist der Cronjob aktiv (optional)
     * @param  null|string  $name  Cronjob-Name (optional)
     * @param  null|string  $url  Aufzurufende URL (optional)
     * @param  null|SelectedInterval  $selectedInterval  Aktivierungsintervall des Cronjobs (optional)
     * @param  null|string  $cronInterval  Benutzerdefiniertes Aktivierungsintervall (optional)
     */
    public function __construct(
        protected int $webspaceCronjobId,
        protected ?bool $active = null,
        protected ?string $name = null,
        protected ?string $url = null,
        protected ?SelectedInterval $selectedInterval = null,
        protected ?string $cronInterval = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspaceCronjobID' => $this->webspaceCronjobId,
            'active' => $this->active,
            'name' => $this->name,
            'url' => $this->url,
            'selectedInterval' => $this->selectedInterval?->value,
            'cronInterval' => $this->cronInterval,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/updateCronjob';
    }
}
