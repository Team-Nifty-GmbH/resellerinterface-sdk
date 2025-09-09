<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\MessageQueue\MessageQueueDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\MessageQueue\MessageQueueRead;
use TeamNiftyGmbH\ResellerInterface\Requests\MessageQueue\MessageQueueStatus;

class MessageQueue extends BaseResource
{
    /**
     * @param  int  $queueMessageId  ID der Nachricht
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function messageQueueDelete(int $queueMessageId): Response
    {
        return $this->connector->send(new MessageQueueDelete($queueMessageId));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function messageQueueRead(): Response
    {
        return $this->connector->send(new MessageQueueRead());
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function messageQueueStatus(): Response
    {
        return $this->connector->send(new MessageQueueStatus());
    }
}
