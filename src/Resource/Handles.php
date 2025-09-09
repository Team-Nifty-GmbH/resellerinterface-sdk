<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleClone;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleDeactivate;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleGetDetailKeys;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleList;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleReactivate;
use TeamNiftyGmbH\ResellerInterface\Requests\Handles\HandleUpdate;

class Handles extends BaseResource
{
    /**
     * @param  string  $alias  Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleClone(string $alias): Response
    {
        return $this->connector->send(new HandleClone($alias));
    }

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  Type  $type  Typ des Handles
     * @param  null|string  $company  Firmenname (optional)
     * @param  string  $firstname  Vorname
     * @param  string  $lastname  Nachname
     * @param  string  $street  Straße
     * @param  string  $city  Stadt
     * @param  string  $postcode  Postleitzahl
     * @param  string  $country  Ländercode ISO 3166-1
     * @param  string  $telephone  Telefonnummer
     * @param  null|string  $fax  Telefaxnummer (optional)
     * @param  string  $email  E-Mail-Adresse
     * @param  string  $tag  Tag
     * @param  array  $additionalParams  Handledaten (siehe Beispiel) [[handle/getDetailKeys](#post-/handle/getDetailKeys)]
     * @param  null|bool  $useExisting  Bestehendes Handle zurückgeben, falls Daten übereinstimmen, anstatt ein neues zu erstellen (optional)
     * @param  null|bool  $disclose  Daten im Whois ausgeben (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleCreate(
        ?int $resellerId,
        Type $type,
        ?string $company,
        string $firstname,
        string $lastname,
        string $street,
        string $city,
        string $postcode,
        string $country,
        string $telephone,
        ?string $fax,
        string $email,
        string $tag,
        array $additionalParams,
        ?bool $useExisting = null,
        ?bool $disclose = null,
    ): Response {
        return $this->connector->send(new HandleCreate($resellerId, $type, $company, $firstname, $lastname, $street, $city, $postcode, $country, $telephone, $fax, $email, $tag, $additionalParams, $useExisting, $disclose));
    }

    /**
     * @param  string  $alias  Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleDeactivate(string $alias): Response
    {
        return $this->connector->send(new HandleDeactivate($alias));
    }

    /**
     * @param  string  $alias  Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleDetails(string $alias): Response
    {
        return $this->connector->send(new HandleDetails($alias));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleGetDetailKeys(): Response
    {
        return $this->connector->send(new HandleGetDetailKeys());
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|bool  $trustee  Liste auf Trustee-Handles beschränken (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleList(
        ?ResellerID $resellerId = null,
        ?bool $trustee = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new HandleList($resellerId, $trustee, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  string  $alias  Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleReactivate(string $alias): Response
    {
        return $this->connector->send(new HandleReactivate($alias));
    }

    /**
     * @param  string  $alias  Alias
     * @param  string  $street  Straße
     * @param  string  $city  Stadt
     * @param  string  $postcode  Postleitzahl
     * @param  string  $telephone  Telefonnummer
     * @param  string  $fax  Telefaxnummer
     * @param  string  $email  E-Mail-Adresse
     * @param  string  $tag  Tag
     * @param  array  $additionalParams  Handledaten (siehe Beispiel) [[handle/getDetailKeys](#post-/handle/getDetailKeys)]
     * @param  null|bool  $disclose  Daten im Whois ausgeben (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function handleUpdate(
        string $alias,
        string $street,
        string $city,
        string $postcode,
        string $telephone,
        string $fax,
        string $email,
        string $tag,
        array $additionalParams,
        ?bool $disclose = null,
    ): Response {
        return $this->connector->send(new HandleUpdate($alias, $street, $city, $postcode, $telephone, $fax, $email, $tag, $additionalParams, $disclose));
    }
}
