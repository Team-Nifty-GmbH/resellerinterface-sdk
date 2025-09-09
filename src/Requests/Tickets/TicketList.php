<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Ticket;

/**
 * post_ticket_list
 *
 * Listet bestehende Service-Tickets auf<br /><br />Benötigte Rechte:<br />**Ticketanfragen einsehen**
 * (api.ticket.view)<br /><br /><a target="_blank" href="/core/api#ticket/list">In Reseller-Interface
 * öffnen</a>
 */
class TicketList extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?int $offset = null,
        protected ?int $limit = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Ticket::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['offset' => $this->offset, 'limit' => $this->limit]);
    }

    public function resolveEndpoint(): string
    {
        return '/ticket/list';
    }
}
