<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Ens\EnsCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Ens\EnsDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Ens\EnsList;

class Ens extends BaseResource
{
    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  array  $nameserver  Nameserver
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ensCreate(?int $resellerId, array $nameserver): Response
    {
        return $this->connector->send(new EnsCreate($resellerId, $nameserver));
    }

    /**
     * @param  int  $ensId  ID eines externen Nameserver-Sets
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ensDelete(int $ensId): Response
    {
        return $this->connector->send(new EnsDelete($ensId));
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ensList(?int $resellerId = null): Response
    {
        return $this->connector->send(new EnsList($resellerId));
    }
}
