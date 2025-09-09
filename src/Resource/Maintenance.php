<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Maintenance\MaintenanceDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Maintenance\MaintenanceList;

class Maintenance extends BaseResource
{
    /**
     * @param  int  $maintenanceEntryId  Wartungs-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function maintenanceDetails(int $maintenanceEntryId): Response
    {
        return $this->connector->send(new MaintenanceDetails($maintenanceEntryId));
    }

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function maintenanceList(
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?array $include = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new MaintenanceList($search, $filter, $sort, $include, $offset, $limit));
    }
}
