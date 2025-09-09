<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Billing\BillingApproveOrder;
use TeamNiftyGmbH\ResellerInterface\Requests\Billing\BillingListForRenewal;
use TeamNiftyGmbH\ResellerInterface\Requests\Billing\BillingListOrders;
use TeamNiftyGmbH\ResellerInterface\Requests\Billing\BillingOrderDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Billing\BillingRevokeOrder;

class Billing extends BaseResource
{
    /**
     * @param  int  $orderId  Bestell-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function billingApproveOrder(int $orderId): Response
    {
        return $this->connector->send(new BillingApproveOrder($orderId));
    }

    /**
     * @param  null|int  $days  Zeitraum in Tagen, für den anstehende Verlängerungen angezeigt werden sollen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function billingListForRenewal(
        ?int $days = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new BillingListForRenewal($days, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function billingListOrders(
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new BillingListOrders($search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $orderId  Bestell-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function billingOrderDetails(int $orderId): Response
    {
        return $this->connector->send(new BillingOrderDetails($orderId));
    }

    /**
     * @param  int  $orderId  Bestell-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function billingRevokeOrder(int $orderId): Response
    {
        return $this->connector->send(new BillingRevokeOrder($orderId));
    }
}
