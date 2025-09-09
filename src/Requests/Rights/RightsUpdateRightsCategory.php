<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Rights;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;

/**
 * post_rights_updateRightsCategory
 *
 * Ändert eine bestehende Rechte-Kategorie
 * • Eine Übersicht der zur Verfügung stehenden
 * Rechte-Gruppen kannst Du mit rightsGroup/list abrufen.<br /><br />Benötigte Rechte:<br />**Rechte
 * verwalten** (api.rights.manage)<br /><br /><a target="_blank"
 * href="/core/api#rights/updateRightsCategory">In Reseller-Interface öffnen</a>
 */
class RightsUpdateRightsCategory extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $id  Rechte-Kategorie-ID
     * @param  null|string  $name  Kategorie-Name (optional)
     * @param  null|array  $rightsGroups  Rechte-Gruppen-IDs (optional)
     * @param  null|SettingsMode  $rightsGroupsMode  Modus für die angegebenen Rechte-Gruppen-IDs (optional)
     */
    public function __construct(
        protected int $id,
        protected ?string $name = null,
        protected ?array $rightsGroups = null,
        protected ?SettingsMode $rightsGroupsMode = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'rightsGroups' => $this->rightsGroups,
            'rightsGroupsMode' => $this->rightsGroupsMode?->value,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/rights/updateRightsCategory';
    }
}
