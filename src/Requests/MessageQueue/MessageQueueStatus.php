<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\MessageQueue;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_messageQueue_status
 *
 * Fragt den Status der Nachrichtenwarteschlagen ab
 * Um Nachrichten für die Message-Queue zu empfangen
 * muss dieses bei den Benachrichtigungseinstellungen aktiviert werden [Benachrichtigungen »
 * Systemmeldungen](https://my.resellerinterface.de/settings/notifications).<br /><br />Benötigte
 * Rechte:<br />**Messagequeue verwalten** (api.messageQueue.manage)<br /><br /><a target="_blank"
 * href="/core/api#messageQueue/status">In Reseller-Interface öffnen</a>
 */
class MessageQueueStatus extends Request implements HasBody
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
        return '/messageQueue/status';
    }
}
