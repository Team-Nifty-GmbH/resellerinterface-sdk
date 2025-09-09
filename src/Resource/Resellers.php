<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerOrderGroupName;
use TeamNiftyGmbH\ResellerInterface\Enums\RightsCategoryMode;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerCancelGroup;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerCancelModule;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerDeleteSmtp;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerExists;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerList;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerListModules;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerListUndeliveredMail;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerLogin;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerLoginReseller;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerLogout;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerLogoutReseller;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerOrderGroup;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerOrderModule;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerPwReset;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerRetryUndeliveredMailCheck;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerSettings;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerUncancelGroup;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerUncancelModule;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerUndelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerUpdate;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerUpdateSmtp;

class Resellers extends BaseResource
{
    /**
     * @param  null|string  $reason  Grund der Kündigung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerCancelGroup(?string $reason = null): Response
    {
        return $this->connector->send(new ResellerCancelGroup($reason));
    }

    /**
     * @param  string  $name  Modul
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerCancelModule(string $name): Response
    {
        return $this->connector->send(new ResellerCancelModule($name));
    }

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
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerCreate(
        ?string $company,
        string $firstname,
        string $lastname,
        ?string $addon,
        string $street,
        string $number,
        string $postcode,
        string $city,
        ?string $country,
        string $mail,
        string $phone,
        string $fax,
        string $vatId,
        ?array $billingAddress = null,
        ?bool $shoppingcart = null,
        ?array $settings = null,
        ?array $userSettings = null,
        ?string $username = null,
        ?string $password = null,
        ?bool $forceUserAuth = null,
        ?bool $gdprPersistent = null,
        ?array $rights = null,
        ?array $rightsGroups = null,
        ?int $rightsCategory = null,
        ?int $birthdayDay = null,
        ?int $birthdayMonth = null,
        ?int $birthdayYear = null,
        ?bool $welcomeMail = null,
    ): Response {
        return $this->connector->send(new ResellerCreate($company, $firstname, $lastname, $addon, $street, $number, $postcode, $city, $country, $mail, $phone, $fax, $vatId, $billingAddress, $shoppingcart, $settings, $userSettings, $username, $password, $forceUserAuth, $gdprPersistent, $rights, $rightsGroups, $rightsCategory, $birthdayDay, $birthdayMonth, $birthdayYear, $welcomeMail));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerDelete(?string $resellerId = null): Response
    {
        return $this->connector->send(new ResellerDelete($resellerId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerDeleteSmtp(): Response
    {
        return $this->connector->send(new ResellerDeleteSmtp());
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerDetails(?int $resellerId = null): Response
    {
        return $this->connector->send(new ResellerDetails($resellerId));
    }

    /**
     * @param  string  $username  Benutzername
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerExists(string $username): Response
    {
        return $this->connector->send(new ResellerExists($username));
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|bool  $includeSelf  Eigenen Account mit auflisten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerList(
        ?ResellerID $resellerId = null,
        ?bool $includeSelf = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new ResellerList($resellerId, $includeSelf, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerListModules(): Response
    {
        return $this->connector->send(new ResellerListModules());
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerListUndeliveredMail(): Response
    {
        return $this->connector->send(new ResellerListUndeliveredMail());
    }

    /**
     * @param  string  $username  Benutzername
     * @param  string  $password  Passwort
     * @param  null|string  $sms  TwoFA SMS-Code (optional)
     * @param  null|string  $totp  TwoFA TOTP-Code (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerLogin(
        string $username,
        string $password,
        ?string $sms = null,
        ?string $totp = null,
    ): Response {
        return $this->connector->send(new ResellerLogin($username, $password, $sms, $totp));
    }

    /**
     * @param  int  $resellerId  Reseller-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerLoginReseller(int $resellerId): Response
    {
        return $this->connector->send(new ResellerLoginReseller($resellerId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerLogout(): Response
    {
        return $this->connector->send(new ResellerLogout());
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerLogoutReseller(): Response
    {
        return $this->connector->send(new ResellerLogoutReseller());
    }

    /**
     * @param  ResellerOrderGroupName  $name  Reseller-Paket
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerOrderGroup(ResellerOrderGroupName $name): Response
    {
        return $this->connector->send(new ResellerOrderGroup($name));
    }

    /**
     * @param  string  $name  Modul
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerOrderModule(string $name): Response
    {
        return $this->connector->send(new ResellerOrderModule($name));
    }

    /**
     * @param  string  $username  Benutzername
     * @param  null|string  $password  Passwort (optional)
     * @param  null|string  $token  Token zur Änderung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerPwReset(string $username, ?string $password = null, ?string $token = null): Response
    {
        return $this->connector->send(new ResellerPwReset($username, $password, $token));
    }

    /**
     * @param  int  $id  Undelivered-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerRetryUndeliveredMailCheck(int $id): Response
    {
        return $this->connector->send(new ResellerRetryUndeliveredMailCheck($id));
    }

    /**
     * @param  null|SettingsMode  $settingsMode  Modus für die angegebenen Einstellungen (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listResellerSettings](#post-/setting/listResellerSettings)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerSettings(?SettingsMode $settingsMode = null, ?array $settings = null): Response
    {
        return $this->connector->send(new ResellerSettings($settingsMode, $settings));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerUncancelGroup(): Response
    {
        return $this->connector->send(new ResellerUncancelGroup());
    }

    /**
     * @param  string  $name  Modul
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerUncancelModule(string $name): Response
    {
        return $this->connector->send(new ResellerUncancelModule($name));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerUndelete(?string $resellerId = null): Response
    {
        return $this->connector->send(new ResellerUndelete($resellerId));
    }

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
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerUpdate(
        ?string $resellerId,
        ?string $company,
        string $firstname,
        string $lastname,
        ?string $addon,
        string $street,
        string $number,
        string $postcode,
        string $city,
        ?string $country,
        string $mail,
        string $phone,
        string $fax,
        string $vatId,
        ?array $billingAddress = null,
        ?bool $billingAddressRemove = null,
        ?SettingsMode $settingsMode = null,
        ?array $settings = null,
        ?SettingsMode $userSettingsMode = null,
        ?array $userSettings = null,
        ?string $username = null,
        ?string $password = null,
        ?bool $forceUserAuth = null,
        ?bool $gdprPersistent = null,
        ?SettingsMode $rightsMode = null,
        ?array $rights = null,
        ?SettingsMode $rightsGroupsMode = null,
        ?array $rightsGroups = null,
        ?RightsCategoryMode $rightsCategoryMode = null,
        ?int $rightsCategory = null,
        ?int $birthdayDay = null,
        ?int $birthdayMonth = null,
        ?int $birthdayYear = null,
    ): Response {
        return $this->connector->send(new ResellerUpdate($resellerId, $company, $firstname, $lastname, $addon, $street, $number, $postcode, $city, $country, $mail, $phone, $fax, $vatId, $billingAddress, $billingAddressRemove, $settingsMode, $settings, $userSettingsMode, $userSettings, $username, $password, $forceUserAuth, $gdprPersistent, $rightsMode, $rights, $rightsGroupsMode, $rightsGroups, $rightsCategoryMode, $rightsCategory, $birthdayDay, $birthdayMonth, $birthdayYear));
    }

    /**
     * @param  null|string  $fromName  (optional)
     * @param  null|string  $replyAddress  (optional)
     * @param  null|string  $replyName  (optional)
     * @param  null|string  $signatureHtml  (optional)
     * @param  null|string  $signatureText  (optional)
     * @param  null|string  $username  (optional)
     * @param  null|string  $password  (optional)
     * @param  null|string  $pgpPrivateKey  (optional)
     * @param  null|string  $pgpPublicKey  Öffentlicher PGP-Schlüssel (ASCII-Format) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function resellerUpdateSmtp(
        ?string $fromName,
        ?string $replyAddress,
        ?string $replyName,
        ?string $signatureHtml,
        ?string $signatureText,
        string $host,
        ?string $username,
        ?string $password,
        int $port,
        string $fromAddress,
        string $returnPathAddress,
        string $abuseCenterAddress,
        ?string $pgpPrivateKey = null,
        ?string $pgpPublicKey = null,
    ): Response {
        return $this->connector->send(new ResellerUpdateSmtp($fromName, $replyAddress, $replyName, $signatureHtml, $signatureText, $host, $username, $password, $port, $fromAddress, $returnPathAddress, $abuseCenterAddress, $pgpPrivateKey, $pgpPublicKey));
    }
}
