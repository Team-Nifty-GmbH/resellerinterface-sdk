<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Gdpr\GdprDeleteExport;
use TeamNiftyGmbH\ResellerInterface\Requests\Gdpr\GdprGetExport;
use TeamNiftyGmbH\ResellerInterface\Requests\Gdpr\GdprRequestExport;

class Gdpr extends BaseResource
{
    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function gdprDeleteExport(?string $resellerId = null): Response
    {
        return $this->connector->send(new GdprDeleteExport($resellerId));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function gdprGetExport(?string $resellerId = null): Response
    {
        return $this->connector->send(new GdprGetExport($resellerId));
    }

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function gdprRequestExport(?string $resellerId = null): Response
    {
        return $this->connector->send(new GdprRequestExport($resellerId));
    }
}
