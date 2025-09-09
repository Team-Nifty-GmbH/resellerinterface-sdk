<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;

/**
 * post_domain_list
 *
 * Listet alle Domains auf<br>
 * • Es werden maximal 1000 Einträge zurückgegeben<br /><br
 * />Benötigte Rechte:<br />**Domains einsehen** (api.domain.view)<br /><br /><a target="_blank"
 * href="/core/api#domain/list">In Reseller-Interface öffnen</a>
 */
class DomainList extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|array  $stateFilter  Status-Filter (optional)
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?ResellerID $resellerId = null,
        protected ?array $stateFilter = null,
        protected ?bool $csv = null,
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
            'resellerID' => $this->resellerId?->value,
            'stateFilter' => $this->stateFilter,
            'csv' => $this->csv,
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
        return '/domain/list';
    }
}
