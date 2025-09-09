<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Tlds\TldDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Tlds\TldList;
use TeamNiftyGmbH\ResellerInterface\Requests\Tlds\TldListCategories;

class Tlds extends BaseResource
{
    /**
     * @param  string  $tld  Top-Level-Domain
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tldDetails(string $tld): Response
    {
        return $this->connector->send(new TldDetails($tld));
    }

    /**
     * @param  null|array  $category  TLD-Kategorie (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tldList(
        ?array $category = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new TldList($category, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tldListCategories(): Response
    {
        return $this->connector->send(new TldListCategories());
    }
}
