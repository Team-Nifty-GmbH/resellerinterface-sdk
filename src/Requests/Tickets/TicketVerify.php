<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Ticket;

/**
 * post_ticket_verify
 *
 * Verifiziert eine Service-Ticket-Nachricht die nicht verifiziert ist<br /><br />Benötigte Rechte:<br
 * />**Ticketanfragen verwalten** (api.ticket.manage)<br /><br /><a target="_blank"
 * href="/core/api#ticket/verify">In Reseller-Interface öffnen</a>
 */
class TicketVerify extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $ticketMessageId  Ticket-Service-Nachricht-ID
     * @param  string  $ticketPassword  Ticket-Passwort
     */
    public function __construct(
        protected int $ticketMessageId,
        protected string $ticketPassword,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Ticket::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['ticketMessageID' => $this->ticketMessageId, 'ticketPassword' => $this->ticketPassword]);
    }

    public function resolveEndpoint(): string
    {
        return '/ticket/verify';
    }
}
