<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Ticket;

/**
 * post_ticket_details
 *
 * Ruft Informationen zu einem Service-Ticket ab<br /><br />Benötigte Rechte:<br />**Ticketanfragen
 * einsehen** (api.ticket.view)<br /><br /><a target="_blank" href="/core/api#ticket/details">In
 * Reseller-Interface öffnen</a>
 */
class TicketDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $ticketId  Service-Ticket-ID
     */
    public function __construct(
        protected int $ticketId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Ticket::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['ticketID' => $this->ticketId]);
    }

    public function resolveEndpoint(): string
    {
        return '/ticket/details';
    }
}
