<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;

/**
 * post_domain_listTransferRequests
 *
 * Listet eingegangene Transfer-Anfragen auf<br /><br />Benötigte Rechte:<br />**Domains kündigen**
 * (api.domain.delete)<br /><br /><a target="_blank" href="/core/api#domain/listTransferRequests">In
 * Reseller-Interface öffnen</a>
 */
class DomainListTransferRequests extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?ResellerID $resellerId = null,
        protected ?array $search = null,
        protected ?array $filter = null,
        protected ?array $sort = null,
        protected ?int $offset = null,
        protected ?int $limit = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'resellerID' => $this->resellerId?->value,
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/listTransferRequests';
    }
}
