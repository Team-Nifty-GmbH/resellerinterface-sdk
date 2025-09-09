<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;

/**
 * post_reseller_create
 *
 * Legt einen neuen Reseller an
 * • Es wird immer erst die Rechte-Kategorie, dann die Rechte-Gruppen
 * und danach die Rechte gesetzt, so lassen sich Rechte aus der Rechte-Kategorie und den Rechte-Gruppen
 * überschreiben.
 * • Es werden nur Rechte berücksichtigt die der übergeordnete Benutzer auch
 * besitzt.
 * • Eine Übersicht der zur Verfügung stehenden Einstellungen kannst Du mit
 * reseller/details abrufen.
 * • Eine Übersicht der zur Verfügung stehenden Rechte kannst Du mit
 * user/details abrufen.<br /><br />Benötigte Rechte:<br />**Unterreseller verwalten**
 * (api.reseller.manage)<br /><br /><a target="_blank" href="/core/api#reseller/create">In
 * Reseller-Interface öffnen</a>
 */
class ResellerCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
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
     * @param  null|bool  $shoppingcart  Warenkorb-Erinnerungen versenden (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listResellerSettings](#post-/setting/listResellerSettings)]
     * @param  null|array  $userSettings  Einstellungen für den Haupt-Benutzer des Resellers (optional) [[setting/listUserSettings](#post-/setting/listUserSettings)]
     * @param  null|string  $username  Benutzername (optional)
     * @param  null|string  $password  Passwort (optional)
     * @param  null|bool  $forceUserAuth  TwoFA für Benutzer erzwingen (optional)
     * @param  null|bool  $gdprPersistent  Automatische Account-Löschung unterbinden (optional)
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     * @param  null|array  $rightsGroups  Rechte-Gruppen-IDs (optional) [[rights/listRightsGroups](#post-/rights/listRightsGroups)]
     * @param  null|int  $rightsCategory  Rechte-Kategorie-ID (optional) [[rights/listRightsCategories](#post-/rights/listRightsCategories)]
     * @param  null|int  $birthdayDay  Geburtstag (optional)
     * @param  null|int  $birthdayMonth  Geburtsmonat (optional)
     * @param  null|int  $birthdayYear  Geburtsjahr (optional)
     * @param  null|bool  $welcomeMail  Willkommens-Mail an neuen Reseller senden (inkl. Passwort-festlegen-Link, falls kein Passwort definiert wurde) (optional)
     */
    public function __construct(
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
        protected ?bool $shoppingcart = null,
        protected ?array $settings = null,
        protected ?array $userSettings = null,
        protected ?string $username = null,
        protected ?string $password = null,
        protected ?bool $forceUserAuth = null,
        protected ?bool $gdprPersistent = null,
        protected ?array $rights = null,
        protected ?array $rightsGroups = null,
        protected ?int $rightsCategory = null,
        protected ?int $birthdayDay = null,
        protected ?int $birthdayMonth = null,
        protected ?int $birthdayYear = null,
        protected ?bool $welcomeMail = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Reseller::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
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
            'shoppingcart' => $this->shoppingcart,
            'settings' => $this->settings,
            'userSettings' => $this->userSettings,
            'username' => $this->username,
            'password' => $this->password,
            'forceUserAuth' => $this->forceUserAuth,
            'gdprPersistent' => $this->gdprPersistent,
            'rights' => $this->rights,
            'rightsGroups' => $this->rightsGroups,
            'rightsCategory' => $this->rightsCategory,
            'birthday_day' => $this->birthdayDay,
            'birthday_month' => $this->birthdayMonth,
            'birthday_year' => $this->birthdayYear,
            'welcomeMail' => $this->welcomeMail,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/create';
    }
}
