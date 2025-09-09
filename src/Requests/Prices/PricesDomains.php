<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Prices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_prices_domains
 *
 * Fragt die Preise für Domains ab<br /><br /><a target="_blank" href="/core/api#prices/domains">In
 * Reseller-Interface öffnen</a>
 */
class PricesDomains extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|array  $category  TLD-Kategorie (optional)
     * @param  null|bool  $details  Details (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?array $category = null,
        protected ?bool $details = null,
        protected ?int $runtime = null,
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
            'category' => $this->category,
            'details' => $this->details,
            'runtime' => $this->runtime,
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/prices/domains';
    }
}
