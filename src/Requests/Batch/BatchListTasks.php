<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Batch;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_batch_listTasks
 *
 * Listet Aufträge zu einem Massenauftrag auf<br /><br />Benötigte Rechte:<br />**Massenaufträge
 * einsehen** (api.batchProcessing.view)<br /><br /><a target="_blank"
 * href="/core/api#batch/listTasks">In Reseller-Interface öffnen</a>
 */
class BatchListTasks extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     */
    public function __construct(
        protected int $batchProcessingId,
        protected ?string $search = null,
        protected ?array $filter = null,
        protected ?int $offset = null,
        protected ?int $limit = null,
        protected ?bool $csv = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'batchProcessingID' => $this->batchProcessingId,
            'search' => $this->search,
            'filter' => $this->filter,
            'offset' => $this->offset,
            'limit' => $this->limit,
            'csv' => $this->csv,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/batch/listTasks';
    }
}
