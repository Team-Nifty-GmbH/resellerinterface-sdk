<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\MessageQueue;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_messageQueue_delete
 *
 * Löscht die aktuelle Nachricht (nach Bearbeitung) aus der Queue.
 * Um Nachrichten für die
 * Message-Queue zu empfangen muss dieses bei den Benachrichtigungseinstellungen aktiviert werden
 * [Benachrichtigungen » Systemmeldungen](https://my.resellerinterface.de/settings/notifications).<br
 * /><br />Benötigte Rechte:<br />**Messagequeue verwalten** (api.messageQueue.manage)<br /><br /><a
 * target="_blank" href="/core/api#messageQueue/delete">In Reseller-Interface öffnen</a>
 */
class MessageQueueDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $queueMessageId  ID der Nachricht
     */
    public function __construct(
        protected int $queueMessageId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['queueMessageID' => $this->queueMessageId]);
    }

    public function resolveEndpoint(): string
    {
        return '/messageQueue/delete';
    }
}
