<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Payments\PaymentBalance;
use TeamNiftyGmbH\ResellerInterface\Requests\Payments\PaymentGetCreditLimit;
use TeamNiftyGmbH\ResellerInterface\Requests\Payments\PaymentProtocol;

class Payments extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function paymentBalance(): Response
    {
        return $this->connector->send(new PaymentBalance());
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function paymentGetCreditLimit(): Response
    {
        return $this->connector->send(new PaymentGetCreditLimit());
    }

    /**
     * @param  null|int  $year  Zahlungs-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function paymentProtocol(?int $year = null): Response
    {
        return $this->connector->send(new PaymentProtocol($year));
    }
}
