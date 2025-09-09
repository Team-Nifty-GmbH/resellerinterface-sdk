<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Invoices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_invoice_list
 *
 * Listet die Rechnungen auf<br /><br />Benötigte Rechte:<br />**Finanzen einsehen**
 * (api.finance.view)<br /><br /><a target="_blank" href="/core/api#invoice/list">In Reseller-Interface
 * öffnen</a>
 */
class InvoiceList extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|bool  $withItems  Rechnungsposten mit abrufen (optional)
     * @param  null|bool  $withBalance  Zahlungsverlauf mit abrufen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?bool $withItems = null,
        protected ?bool $withBalance = null,
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
            'withItems' => $this->withItems,
            'withBalance' => $this->withBalance,
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/invoice/list';
    }
}
