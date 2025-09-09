<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Vendor;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainParking\DomainParkingDeleteAccount;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainParking\DomainParkingGetAccount;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainParking\DomainParkingInsert;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainParking\DomainParkingListAccounts;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainParking\DomainParkingSetAccount;

class DomainParking extends BaseResource
{
    /**
     * @param  Vendor  $vendor  Parkingprovider
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainParkingDeleteAccount(Vendor $vendor): Response
    {
        return $this->connector->send(new DomainParkingDeleteAccount($vendor));
    }

    /**
     * @param  Vendor  $vendor  Parkingprovider
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainParkingGetAccount(Vendor $vendor): Response
    {
        return $this->connector->send(new DomainParkingGetAccount($vendor));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  Vendor  $vendor  Parkingprovider
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainParkingInsert(int $domain, Vendor $vendor): Response
    {
        return $this->connector->send(new DomainParkingInsert($domain, $vendor));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainParkingListAccounts(): Response
    {
        return $this->connector->send(new DomainParkingListAccounts());
    }

    /**
     * @param  Vendor  $vendor  Parkingprovider
     * @param  array  $credentials  Die Zugangsdaten als Array
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainParkingSetAccount(Vendor $vendor, array $credentials): Response
    {
        return $this->connector->send(new DomainParkingSetAccount($vendor, $credentials));
    }
}
