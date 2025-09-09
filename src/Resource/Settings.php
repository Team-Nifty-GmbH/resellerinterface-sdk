<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\SubresellerInheritanceMode;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingDetailsResellerSetting;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingDetailsUserSetting;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingListResellerSettings;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingListUserSettings;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingListWebspaceSettings;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingRemoveResellerSetting;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingRemoveUserSetting;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingSetResellerSetting;
use TeamNiftyGmbH\ResellerInterface\Requests\Settings\SettingSetUserSetting;

class Settings extends BaseResource
{
    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingDetailsResellerSetting(?string $resellerId, string $group, string $name): Response
    {
        return $this->connector->send(new SettingDetailsResellerSetting($resellerId, $group, $name));
    }

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingDetailsUserSetting(?string $userId, string $group, string $name): Response
    {
        return $this->connector->send(new SettingDetailsUserSetting($userId, $group, $name));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingListResellerSettings(?string $resellerId = null): Response
    {
        return $this->connector->send(new SettingListResellerSettings($resellerId));
    }

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingListUserSettings(?string $userId = null): Response
    {
        return $this->connector->send(new SettingListUserSettings($userId));
    }

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingListWebspaceSettings(int $webspace): Response
    {
        return $this->connector->send(new SettingListWebspaceSettings($webspace));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingRemoveResellerSetting(?string $resellerId, string $group, string $name): Response
    {
        return $this->connector->send(new SettingRemoveResellerSetting($resellerId, $group, $name));
    }

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingRemoveUserSetting(?string $userId, string $group, string $name): Response
    {
        return $this->connector->send(new SettingRemoveUserSetting($userId, $group, $name));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     * @param  string  $value  Wert
     * @param  null|bool  $forced  Festgelegter Wert wird genutzt, auch wenn durch Vererbung eigentlich nicht änderbar.
     *                             Einstellung wird auf "readonly" gesetzt.
     *                             Kann nur vom direkten Ober-Reseller (parent) verwaltet werden, sofern dieser Schreibrechte für diese Einstellung hat. (optional)
     * @param  null|SubresellerInheritanceMode  $subresellerInheritanceMode  Art der Vererbung (optional)
     * @param  null|string  $subresellerInheritanceModeCustomValue  Wert der Vererbung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingSetResellerSetting(
        ?string $resellerId,
        string $group,
        string $name,
        string $value,
        ?bool $forced = null,
        ?SubresellerInheritanceMode $subresellerInheritanceMode = null,
        ?string $subresellerInheritanceModeCustomValue = null,
    ): Response {
        return $this->connector->send(new SettingSetResellerSetting($resellerId, $group, $name, $value, $forced, $subresellerInheritanceMode, $subresellerInheritanceModeCustomValue));
    }

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     * @param  string  $value  Wert
     * @param  null|bool  $forced  Festgelegter Wert wird genutzt, auch wenn durch Vererbung eigentlich nicht änderbar.
     *                             Einstellung wird auf "readonly" gesetzt.
     *                             Kann nur vom direkten Ober-Reseller (parent) verwaltet werden, sofern dieser Schreibrechte für diese Einstellung hat. (optional)
     * @param  null|SubresellerInheritanceMode  $subuserInheritanceMode  Art der Vererbung (optional)
     * @param  null|string  $subuserInheritanceModeCustomValue  Wert der Vererbung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function settingSetUserSetting(
        ?string $userId,
        string $group,
        string $name,
        string $value,
        ?bool $forced = null,
        ?SubresellerInheritanceMode $subuserInheritanceMode = null,
        ?string $subuserInheritanceModeCustomValue = null,
    ): Response {
        return $this->connector->send(new SettingSetUserSetting($userId, $group, $name, $value, $forced, $subuserInheritanceMode, $subuserInheritanceModeCustomValue));
    }
}
