<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsList;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsPasswordChange;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsUpdate;
use TeamNiftyGmbH\ResellerInterface\Requests\FlexDns\FlexdnsUpdateDns;

class FlexDns extends BaseResource
{
    /**
     * @param  null|string  $category  Kategorie (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsCreate(?string $category = null): Response
    {
        return $this->connector->send(new FlexdnsCreate($category));
    }

    /**
     * @param  int  $userId  Flex-DNS-Benutzer-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsDelete(int $userId): Response
    {
        return $this->connector->send(new FlexdnsDelete($userId));
    }

    /**
     * @param  int  $userId  Flex-DNS-Benutzer-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsDetails(int $userId): Response
    {
        return $this->connector->send(new FlexdnsDetails($userId));
    }

    /**
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsList(
        ?int $offset = null,
        ?int $limit = null,
        ?string $search = null,
        ?array $filter = null,
    ): Response {
        return $this->connector->send(new FlexdnsList($offset, $limit, $search, $filter));
    }

    /**
     * @param  int  $userId  Flex-DNS-Benutzer-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsPasswordChange(int $userId): Response
    {
        return $this->connector->send(new FlexdnsPasswordChange($userId));
    }

    /**
     * @param  int  $userId  Flex-DNS-Benutzer-ID
     * @param  null|string  $category  Kategorie (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsUpdate(int $userId, ?string $category = null): Response
    {
        return $this->connector->send(new FlexdnsUpdate($userId, $category));
    }

    /**
     * @param  null|string  $ipv4  IPv4-Adresse (optional)
     * @param  null|string  $ipv6  IPv6-Adresse (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function flexdnsUpdateDns(?string $ipv4 = null, ?string $ipv6 = null): Response
    {
        return $this->connector->send(new FlexdnsUpdateDns($ipv4, $ipv6));
    }
}
