<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Batch;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_batch_update
 *
 * Aktualisiert einen Massenauftrag<br /><br />Benötigte Rechte:<br />**Massenaufträge verwalten**
 * (api.batchProcessing.manage)<br /><br /><a target="_blank" href="/core/api#batch/update">In
 * Reseller-Interface öffnen</a>
 */
class BatchUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     * @param  string  $dateStarted  Datum, zu dem der Massenauftrag gestartet werden soll
     */
    public function __construct(
        protected int $batchProcessingId,
        protected string $dateStarted,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['batchProcessingID' => $this->batchProcessingId, 'dateStarted' => $this->dateStarted]);
    }

    public function resolveEndpoint(): string
    {
        return '/batch/update';
    }
}
