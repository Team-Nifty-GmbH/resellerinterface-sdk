<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;
use TeamNiftyGmbH\ResellerInterface\Enums\RightsCategoryMode;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;
use TeamNiftyGmbH\ResellerInterface\Enums\State;

/**
 * post_user_update
 *
 * Ändert einen bestehenden Benutzer
 * • Es wird immer erst die Rechte-Kategorie, dann die
 * Rechte-Gruppen und danach die Rechte gesetzt, so lassen sich Rechte aus der Rechte-Kategorie und den
 * Rechte-Gruppen überschreiben.
 * • Es werden nur Rechte berücksichtigt die der übergeordnete
 * Benutzer auch besitzt.
 * • Eine Übersicht der zur Verfügung stehenden Rechte kannst Du mit
 * user/details abrufen.<br /><br />Benötigte Rechte:<br />**Rechte verwalten** (api.rights.manage)<br
 * />**Unterbenutzer verwalten** (api.user.manage)<br /><br /><a target="_blank"
 * href="/core/api#user/update">In Reseller-Interface öffnen</a>
 */
class UserUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $userId  Benutzer-ID
     * @param  string  $username  Benutzername
     * @param  null|string  $password  Passwort (optional)
     * @param  null|State  $state  Statuscode (optional)
     * @param  null|bool  $forceUserAuth  TwoFA für Benutzer erzwingen (optional)
     * @param  null|SettingsMode  $settingsMode  Modus für die angegebenen Einstellungen (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listResellerSettings](#post-/setting/listResellerSettings)]
     * @param  null|SettingsMode  $rightsMode  Modus für die angegebenen Rechte (optional)
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     * @param  null|SettingsMode  $rightsGroupsMode  Modus für die angegebenen Rechte-Gruppen-IDs (optional)
     * @param  null|array  $rightsGroups  Rechte-Gruppen-IDs (optional) [[rights/listRightsGroups](#post-/rights/listRightsGroups)]
     * @param  null|RightsCategoryMode  $rightsCategoryMode  Modus für die angegebene Rechte-Kategorie-ID (optional)
     * @param  null|int  $rightsCategory  Rechte-Kategorie-ID (optional) [[rights/listRightsCategories](#post-/rights/listRightsCategories)]
     */
    public function __construct(
        protected int $userId,
        protected string $username,
        protected ?string $password = null,
        protected ?State $state = null,
        protected ?bool $forceUserAuth = null,
        protected ?SettingsMode $settingsMode = null,
        protected ?array $settings = null,
        protected ?SettingsMode $rightsMode = null,
        protected ?array $rights = null,
        protected ?SettingsMode $rightsGroupsMode = null,
        protected ?array $rightsGroups = null,
        protected ?RightsCategoryMode $rightsCategoryMode = null,
        protected ?int $rightsCategory = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'userID' => $this->userId,
            'username' => $this->username,
            'password' => $this->password,
            'state' => $this->state?->value,
            'forceUserAuth' => $this->forceUserAuth,
            'settingsMode' => $this->settingsMode?->value,
            'settings' => $this->settings,
            'rightsMode' => $this->rightsMode?->value,
            'rights' => $this->rights,
            'rightsGroupsMode' => $this->rightsGroupsMode?->value,
            'rightsGroups' => $this->rightsGroups,
            'rightsCategoryMode' => $this->rightsCategoryMode?->value,
            'rightsCategory' => $this->rightsCategory,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/user/update';
    }
}
