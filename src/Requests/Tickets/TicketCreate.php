<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tickets;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Ticket;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_ticket_create
 *
 * Legt ein neues Service-Ticket an<br /><br />Benötigte Rechte:<br />**Ticketanfragen verwalten**
 * (api.ticket.manage)<br /><br /><a target="_blank" href="/core/api#ticket/create">In
 * Reseller-Interface öffnen</a>
 */
class TicketCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $title  Titel
     * @param  string  $message  Abschließendes Feedback zur Bearbeitung des Service-Tickets
     * @param  null|array  $files  Datei-Anhänge (optional)
     * @param  null|Type  $type  Ticket-Art (optional)
     */
    public function __construct(
        protected string $title,
        protected string $message,
        protected ?array $files = null,
        protected ?Type $type = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Ticket::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['title' => $this->title, 'message' => $this->message, 'files' => $this->files, 'type' => $this->type?->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/ticket/create';
    }
}
