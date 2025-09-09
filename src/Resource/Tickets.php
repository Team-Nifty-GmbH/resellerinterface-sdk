<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Tickets\TicketCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Tickets\TicketDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Tickets\TicketList;
use TeamNiftyGmbH\ResellerInterface\Requests\Tickets\TicketResolve;
use TeamNiftyGmbH\ResellerInterface\Requests\Tickets\TicketRespond;
use TeamNiftyGmbH\ResellerInterface\Requests\Tickets\TicketVerify;

class Tickets extends BaseResource
{
    /**
     * @param  string  $title  Titel
     * @param  string  $message  Abschließendes Feedback zur Bearbeitung des Service-Tickets
     * @param  null|array  $files  Datei-Anhänge (optional)
     * @param  null|Type  $type  Ticket-Art (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ticketCreate(string $title, string $message, ?array $files = null, ?Type $type = null): Response
    {
        return $this->connector->send(new TicketCreate($title, $message, $files, $type));
    }

    /**
     * @param  int  $ticketId  Service-Ticket-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ticketDetails(int $ticketId): Response
    {
        return $this->connector->send(new TicketDetails($ticketId));
    }

    /**
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ticketList(?int $offset = null, ?int $limit = null): Response
    {
        return $this->connector->send(new TicketList($offset, $limit));
    }

    /**
     * @param  int  $ticketId  Service-Ticket-ID
     * @param  string  $ticketPassword  Ticket-Passwort
     * @param  bool  $resolved  Ist das Service-Ticket gelöst?
     * @param  null|string  $message  Abschließendes Feedback zur Bearbeitung des Service-Tickets (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ticketResolve(
        int $ticketId,
        string $ticketPassword,
        bool $resolved,
        ?string $message = null,
    ): Response {
        return $this->connector->send(new TicketResolve($ticketId, $ticketPassword, $resolved, $message));
    }

    /**
     * @param  int  $ticketId  Service-Ticket-ID
     * @param  string  $message  Abschließendes Feedback zur Bearbeitung des Service-Tickets
     * @param  null|array  $files  Datei-Anhänge (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ticketRespond(int $ticketId, string $message, ?array $files = null): Response
    {
        return $this->connector->send(new TicketRespond($ticketId, $message, $files));
    }

    /**
     * @param  int  $ticketMessageId  Ticket-Service-Nachricht-ID
     * @param  string  $ticketPassword  Ticket-Passwort
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function ticketVerify(int $ticketMessageId, string $ticketPassword): Response
    {
        return $this->connector->send(new TicketVerify($ticketMessageId, $ticketPassword));
    }
}
