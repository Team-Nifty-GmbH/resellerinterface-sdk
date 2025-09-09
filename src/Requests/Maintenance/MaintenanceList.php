<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Maintenance;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_maintenance_list
 *
 * Listet Wartungsmeldungen auf<br /><br /><a target="_blank" href="/core/api#maintenance/list">In
 * Reseller-Interface öffnen</a>
 */
class MaintenanceList extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?array $search = null,
        protected ?array $filter = null,
        protected ?array $sort = null,
        protected ?array $include = null,
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
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'include' => $this->include,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/maintenance/list';
    }
}
