<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Prices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_prices_webspaces
 *
 * Ruft die Preise für Webspace-Pakete ab<br /><br /><a target="_blank"
 * href="/core/api#prices/webspaces">In Reseller-Interface öffnen</a>
 */
class PricesWebspaces extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|bool  $details  Details (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?bool $details = null,
        protected ?int $runtime = null,
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
            'details' => $this->details,
            'runtime' => $this->runtime,
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
        return '/prices/webspaces';
    }
}
