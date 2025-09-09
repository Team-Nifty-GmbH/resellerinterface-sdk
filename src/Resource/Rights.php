<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsCreateRightsCategory;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsCreateRightsGroup;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsDeleteRightsCategory;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsDeleteRightsGroup;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsDetailsRightsCategory;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsDetailsRightsGroup;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsList;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsListRightsCategories;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsListRightsGroups;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsUpdateRightsCategory;
use TeamNiftyGmbH\ResellerInterface\Requests\Rights\RightsUpdateRightsGroup;

class Rights extends BaseResource
{
    /**
     * @param  string  $name  Gruppen-Name
     * @param  array  $rightsGroups  Rechte-Gruppen-IDs
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsCreateRightsCategory(string $name, array $rightsGroups): Response
    {
        return $this->connector->send(new RightsCreateRightsCategory($name, $rightsGroups));
    }

    /**
     * @param  string  $name  Gruppen-Name
     * @param  bool  $rightsState  Wert der Rechte-Gruppe
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsCreateRightsGroup(string $name, bool $rightsState, ?array $rights = null): Response
    {
        return $this->connector->send(new RightsCreateRightsGroup($name, $rightsState, $rights));
    }

    /**
     * @param  int  $id  Rechte-Kategorie-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsDeleteRightsCategory(int $id): Response
    {
        return $this->connector->send(new RightsDeleteRightsCategory($id));
    }

    /**
     * @param  int  $id  Gruppen-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsDeleteRightsGroup(int $id): Response
    {
        return $this->connector->send(new RightsDeleteRightsGroup($id));
    }

    /**
     * @param  int  $id  Rechte-Kategorie-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsDetailsRightsCategory(int $id): Response
    {
        return $this->connector->send(new RightsDetailsRightsCategory($id));
    }

    /**
     * @param  int  $id  Gruppen-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsDetailsRightsGroup(int $id): Response
    {
        return $this->connector->send(new RightsDetailsRightsGroup($id));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsList(): Response
    {
        return $this->connector->send(new RightsList());
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsListRightsCategories(?int $resellerId = null): Response
    {
        return $this->connector->send(new RightsListRightsCategories($resellerId));
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsListRightsGroups(?int $resellerId = null): Response
    {
        return $this->connector->send(new RightsListRightsGroups($resellerId));
    }

    /**
     * @param  int  $id  Rechte-Kategorie-ID
     * @param  null|string  $name  Kategorie-Name (optional)
     * @param  null|array  $rightsGroups  Rechte-Gruppen-IDs (optional)
     * @param  null|SettingsMode  $rightsGroupsMode  Modus für die angegebenen Rechte-Gruppen-IDs (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsUpdateRightsCategory(
        int $id,
        ?string $name = null,
        ?array $rightsGroups = null,
        ?SettingsMode $rightsGroupsMode = null,
    ): Response {
        return $this->connector->send(new RightsUpdateRightsCategory($id, $name, $rightsGroups, $rightsGroupsMode));
    }

    /**
     * @param  int  $id  Gruppen-ID
     * @param  string  $name  Gruppen-Name
     * @param  bool  $rightsState  Wert der Rechte-Gruppe
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     * @param  null|SettingsMode  $rightsMode  Modus für die angegebenen Rechte (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function rightsUpdateRightsGroup(
        int $id,
        string $name,
        bool $rightsState,
        ?array $rights = null,
        ?SettingsMode $rightsMode = null,
    ): Response {
        return $this->connector->send(new RightsUpdateRightsGroup($id, $name, $rightsState, $rights, $rightsMode));
    }
}
