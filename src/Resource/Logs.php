<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Logs\LogGet;

class Logs extends BaseResource
{
    /**
     * @param  null|int  $forResellerId  Reseller-ID (optional)
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  null|string  $dateFrom  Von Zeitpunkt (optional)
     * @param  null|string  $dateTill  Bis Zeitpunkt (optional)
     * @param  null|Type  $type  Objekt-Typ (optional)
     * @param  null|int  $typeId  Objekt-ID (optional)
     * @param  null|string  $typeName  Objekt-Bezeichnung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function logGet(
        ?int $forResellerId = null,
        ?int $resellerId = null,
        ?int $userId = null,
        ?string $dateFrom = null,
        ?string $dateTill = null,
        ?Type $type = null,
        ?int $typeId = null,
        ?string $typeName = null,
    ): Response {
        return $this->connector->send(new LogGet($forResellerId, $resellerId, $userId, $dateFrom, $dateTill, $type, $typeId, $typeName));
    }
}
