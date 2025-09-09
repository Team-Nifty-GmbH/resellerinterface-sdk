<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Vns\VnsCheck;
use TeamNiftyGmbH\ResellerInterface\Requests\Vns\VnsCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Vns\VnsDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Vns\VnsList;

class Vns extends BaseResource
{
    /**
     * @param  array  $nameserver  Liste an Domains, die als virtuelle Nameserver verwendet werden sollen
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function vnsCheck(array $nameserver): Response
    {
        return $this->connector->send(new VnsCheck($nameserver));
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  string  $soaMail  E-Mail-Adresse der Verantwortlichen für die Zone
     * @param  array  $nameserver  Liste an Domains, die als virtuelle Nameserver verwendet werden sollen
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function vnsCreate(?int $resellerId, string $soaMail, array $nameserver): Response
    {
        return $this->connector->send(new VnsCreate($resellerId, $soaMail, $nameserver));
    }

    /**
     * @param  int  $vnsId  ID eines virtuellen Nameservers
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function vnsDelete(int $vnsId): Response
    {
        return $this->connector->send(new VnsDelete($vnsId));
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function vnsList(?int $resellerId = null): Response
    {
        return $this->connector->send(new VnsList($resellerId));
    }
}
