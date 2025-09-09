<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;
use TeamNiftyGmbH\ResellerInterface\Enums\RightsCategoryMode;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;

/**
 * post_reseller_update
 *
 * Ändert einen bestehenden Reseller
 * • Die orangenen Felder können nur als Ober-Reseller (parent)
 * gesetzt werden.
 * • Es wird immer erst die Rechte-Kategorie, dann die Rechte-Gruppen und danach die
 * Rechte gesetzt, so lassen sich Rechte aus der Rechte-Kategorie und den Rechte-Gruppen
 * überschreiben.
 * • Es werden nur Rechte berücksichtigt die der übergeordnete Benutzer auch
 * besitzt.
 * • Eine Übersicht der zur Verfügung stehenden Einstellungen kannst Du mit
 * reseller/details abrufen.
 * • Eine Übersicht der zur Verfügung stehenden Rechte kannst Du mit
 * user/details abrufen.<br /><br />Optionale Rechte:<br />**Unterreseller verwalten**
 * (api.reseller.manage)<br />**Eigene Resellerdaten verwalten** (api.reseller.manageSelf)<br /><br
 * /><a target="_blank" href="/core/api#reseller/update">In Reseller-Interface öffnen</a>
 */
class ResellerUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     * @param  null|string  $company  Firmenname (optional)
     * @param  string  $firstname  Vorname
     * @param  string  $lastname  Nachname
     * @param  null|string  $addon  Adresszusatz (optional)
     * @param  string  $street  Straße
     * @param  string  $number  Hausnummer
     * @param  string  $postcode  Postleitzahl
     * @param  string  $city  Stadt
     * @param  null|string  $country  Ländercode ISO 3166-1 (optional)
     * @param  string  $mail  E-Mail-Adresse
     * @param  string  $phone  Telefonnummer
     * @param  string  $fax  Telefaxnummer
     * @param  string  $vatId  Umsatzsteuer-ID
     * @param  null|array  $billingAddress  Rechnungsempfänger Adresse (optional)
     * @param  null|bool  $billingAddressRemove  Rechnumgsempfänger löschen (optional)
     * @param  null|SettingsMode  $settingsMode  Modus für die angegebenen Einstellungen (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listResellerSettings](#post-/setting/listResellerSettings)]
     * @param  null|SettingsMode  $userSettingsMode  Modus für die angegebenen Benutzer-Einstellungen (optional)
     * @param  null|array  $userSettings  Einstellungen für den Haupt-Benutzer des Resellers (optional) [[setting/listUserSettings](#post-/setting/listUserSettings)]
     * @param  null|string  $username  Benutzername (optional)
     * @param  null|string  $password  Passwort (optional)
     * @param  null|bool  $forceUserAuth  TwoFA für Benutzer erzwingen (optional)
     * @param  null|bool  $gdprPersistent  Automatische Account-Löschung unterbinden (optional)
     * @param  null|SettingsMode  $rightsMode  Modus für die angegebenen Rechte (optional)
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     * @param  null|SettingsMode  $rightsGroupsMode  Modus für die angegebenen Rechte-Gruppen-IDs (optional)
     * @param  null|array  $rightsGroups  Rechte-Gruppen-IDs (optional) [[rights/listRightsGroups](#post-/rights/listRightsGroups)]
     * @param  null|RightsCategoryMode  $rightsCategoryMode  Modus für die angegebene Rechte-Kategorie-ID (optional)
     * @param  null|int  $rightsCategory  Rechte-Kategorie-ID (optional) [[rights/listRightsCategories](#post-/rights/listRightsCategories)]
     * @param  null|int  $birthdayDay  Geburtstag (optional)
     * @param  null|int  $birthdayMonth  Geburtsmonat (optional)
     * @param  null|int  $birthdayYear  Geburtsjahr (optional)
     */
    public function __construct(
        protected ?string $resellerId,
        protected ?string $company,
        protected string $firstname,
        protected string $lastname,
        protected ?string $addon,
        protected string $street,
        protected string $number,
        protected string $postcode,
        protected string $city,
        protected ?string $country,
        protected string $mail,
        protected string $phone,
        protected string $fax,
        protected string $vatId,
        protected ?array $billingAddress = null,
        protected ?bool $billingAddressRemove = null,
        protected ?SettingsMode $settingsMode = null,
        protected ?array $settings = null,
        protected ?SettingsMode $userSettingsMode = null,
        protected ?array $userSettings = null,
        protected ?string $username = null,
        protected ?string $password = null,
        protected ?bool $forceUserAuth = null,
        protected ?bool $gdprPersistent = null,
        protected ?SettingsMode $rightsMode = null,
        protected ?array $rights = null,
        protected ?SettingsMode $rightsGroupsMode = null,
        protected ?array $rightsGroups = null,
        protected ?RightsCategoryMode $rightsCategoryMode = null,
        protected ?int $rightsCategory = null,
        protected ?int $birthdayDay = null,
        protected ?int $birthdayMonth = null,
        protected ?int $birthdayYear = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Reseller::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'resellerID' => $this->resellerId,
            'company' => $this->company,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'addon' => $this->addon,
            'street' => $this->street,
            'number' => $this->number,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'country' => $this->country,
            'mail' => $this->mail,
            'phone' => $this->phone,
            'fax' => $this->fax,
            'vatID' => $this->vatId,
            'billingAddress' => $this->billingAddress,
            'billingAddressRemove' => $this->billingAddressRemove,
            'settingsMode' => $this->settingsMode?->value,
            'settings' => $this->settings,
            'userSettingsMode' => $this->userSettingsMode?->value,
            'userSettings' => $this->userSettings,
            'username' => $this->username,
            'password' => $this->password,
            'forceUserAuth' => $this->forceUserAuth,
            'gdprPersistent' => $this->gdprPersistent,
            'rightsMode' => $this->rightsMode?->value,
            'rights' => $this->rights,
            'rightsGroupsMode' => $this->rightsGroupsMode?->value,
            'rightsGroups' => $this->rightsGroups,
            'rightsCategoryMode' => $this->rightsCategoryMode?->value,
            'rightsCategory' => $this->rightsCategory,
            'birthday_day' => $this->birthdayDay,
            'birthday_month' => $this->birthdayMonth,
            'birthday_year' => $this->birthdayYear,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/update';
    }
}
