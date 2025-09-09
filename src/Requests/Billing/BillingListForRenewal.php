<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Billing;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_billing_listForRenewal
 *
 * <br /><br />Benötigte Rechte:<br />**Finanzen einsehen** (api.finance.view)<br /><br /><a
 * target="_blank" href="/core/api#billing/listForRenewal">In Reseller-Interface öffnen</a>
 */
class BillingListForRenewal extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $days  Zeitraum in Tagen, für den anstehende Verlängerungen angezeigt werden sollen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?int $days = null,
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
            'days' => $this->days,
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/billing/listForRenewal';
    }
}
