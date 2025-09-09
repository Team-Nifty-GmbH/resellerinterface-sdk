<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;
use TeamNiftyGmbH\ResellerInterface\Enums\State;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_user_create
 *
 * Legt einen neuen Benutzer an
 * • Es wird immer erst die Rechte-Kategorie, dann die Rechte-Gruppen
 * und danach die Rechte gesetzt, so lassen sich Rechte aus der Rechte-Kategorie und den Rechte-Gruppen
 * überschreiben.
 * • Es werden nur Rechte berücksichtigt die der übergeordnete Benutzer auch
 * besitzt.
 * • Eine Übersicht der zur Verfügung stehenden Rechte kannst Du mit user/details
 * abrufen.<br /><br />Benötigte Rechte:<br />**Rechte verwalten** (api.rights.manage)<br
 * />**Unterbenutzer verwalten** (api.user.manage)<br /><br /><a target="_blank"
 * href="/core/api#user/create">In Reseller-Interface öffnen</a>
 */
class UserCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $username  Benutzername
     * @param  null|string  $password  Passwort (optional)
     * @param  null|State  $state  Statuscode (optional)
     * @param  null|Type  $type  Benutzertyp (optional)
     * @param  null|bool  $forceUserAuth  TwoFA für Benutzer erzwingen (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listUserSettings](#post-/setting/listUserSettings)]
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     * @param  null|array  $rightsGroups  Rechte-Gruppen-IDs (optional) [[rights/listRightsGroups](#post-/rights/listRightsGroups)]
     * @param  null|int  $rightsCategory  Rechte-Kategorie-ID (optional) [[rights/listRightsCategories](#post-/rights/listRightsCategories)]
     */
    public function __construct(
        protected string $username,
        protected ?string $password = null,
        protected ?State $state = null,
        protected ?Type $type = null,
        protected ?bool $forceUserAuth = null,
        protected ?array $settings = null,
        protected ?array $rights = null,
        protected ?array $rightsGroups = null,
        protected ?int $rightsCategory = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'username' => $this->username,
            'password' => $this->password,
            'state' => $this->state?->value,
            'type' => $this->type?->value,
            'forceUserAuth' => $this->forceUserAuth,
            'settings' => $this->settings,
            'rights' => $this->rights,
            'rightsGroups' => $this->rightsGroups,
            'rightsCategory' => $this->rightsCategory,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/user/create';
    }
}
