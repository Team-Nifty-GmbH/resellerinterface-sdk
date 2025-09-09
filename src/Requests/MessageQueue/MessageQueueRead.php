<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\MessageQueue;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_messageQueue_read
 *
 * Gibt die erste Nachricht zurück, welche in der Queue zum Abruf bereit liegt.
 * Um Nachrichten für
 * die Message-Queue zu empfangen muss dieses bei den Benachrichtigungseinstellungen aktiviert werden
 * [Benachrichtigungen » Systemmeldungen](https://my.resellerinterface.de/settings/notifications).<br
 * /><br />Benötigte Rechte:<br />**Messagequeue verwalten** (api.messageQueue.manage)<br /><br /><a
 * target="_blank" href="/core/api#messageQueue/read">In Reseller-Interface öffnen</a>
 */
class MessageQueueRead extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/messageQueue/read';
    }
}
