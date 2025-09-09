<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\RightsCategoryMode;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;
use TeamNiftyGmbH\ResellerInterface\Enums\State;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserList;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserLoginUser;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserLogoutUser;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserPasswordChange;
use TeamNiftyGmbH\ResellerInterface\Requests\Users\UserUpdate;

class Users extends BaseResource
{
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
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userCreate(
        string $username,
        ?string $password = null,
        ?State $state = null,
        ?Type $type = null,
        ?bool $forceUserAuth = null,
        ?array $settings = null,
        ?array $rights = null,
        ?array $rightsGroups = null,
        ?int $rightsCategory = null,
    ): Response {
        return $this->connector->send(new UserCreate($username, $password, $state, $type, $forceUserAuth, $settings, $rights, $rightsGroups, $rightsCategory));
    }

    /**
     * @param  int  $userId  Benutzer-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userDelete(int $userId): Response
    {
        return $this->connector->send(new UserDelete($userId));
    }

    /**
     * @param  int  $userId  Benutzer-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userDetails(int $userId): Response
    {
        return $this->connector->send(new UserDetails($userId));
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|bool  $includeSelf  Eigenen Account mit auflisten (optional)
     * @param  null|bool  $includeMain  Hauptaccount mit auflisten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userList(
        ?ResellerID $resellerId = null,
        ?bool $includeSelf = null,
        ?bool $includeMain = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new UserList($resellerId, $includeSelf, $includeMain, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $userId  Benutzer-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userLoginUser(int $userId): Response
    {
        return $this->connector->send(new UserLoginUser($userId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userLogoutUser(): Response
    {
        return $this->connector->send(new UserLogoutUser());
    }

    /**
     * @param  string  $oldPassword  Passwort
     * @param  string  $newPassword  Passwort
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userPasswordChange(string $oldPassword, string $newPassword): Response
    {
        return $this->connector->send(new UserPasswordChange($oldPassword, $newPassword));
    }

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
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function userUpdate(
        int $userId,
        string $username,
        ?string $password = null,
        ?State $state = null,
        ?bool $forceUserAuth = null,
        ?SettingsMode $settingsMode = null,
        ?array $settings = null,
        ?SettingsMode $rightsMode = null,
        ?array $rights = null,
        ?SettingsMode $rightsGroupsMode = null,
        ?array $rightsGroups = null,
        ?RightsCategoryMode $rightsCategoryMode = null,
        ?int $rightsCategory = null,
    ): Response {
        return $this->connector->send(new UserUpdate($userId, $username, $password, $state, $forceUserAuth, $settingsMode, $settings, $rightsMode, $rights, $rightsGroupsMode, $rightsGroups, $rightsCategoryMode, $rightsCategory));
    }
}
