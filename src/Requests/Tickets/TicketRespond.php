<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Ticket;

/**
 * post_ticket_respond
 *
 * Auf ein bestehendes Service-Ticket antworten<br /><br />Benötigte Rechte:<br />**Ticketanfragen
 * verwalten** (api.ticket.manage)<br /><br /><a target="_blank" href="/core/api#ticket/respond">In
 * Reseller-Interface öffnen</a>
 */
class TicketRespond extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $ticketId  Service-Ticket-ID
     * @param  string  $message  Abschließendes Feedback zur Bearbeitung des Service-Tickets
     * @param  null|array  $files  Datei-Anhänge (optional)
     */
    public function __construct(
        protected int $ticketId,
        protected string $message,
        protected ?array $files = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Ticket::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['ticketID' => $this->ticketId, 'message' => $this->message, 'files' => $this->files]);
    }

    public function resolveEndpoint(): string
    {
        return '/ticket/respond';
    }
}
