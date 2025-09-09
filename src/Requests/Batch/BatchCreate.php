<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Batch;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_batch_create
 *
 * Erstellt einen Massenauftrag<br /><br />Benötigte Rechte:<br />**Massenaufträge verwalten**
 * (api.batchProcessing.manage)<br /><br /><a target="_blank" href="/core/api#batch/create">In
 * Reseller-Interface öffnen</a>
 */
class BatchCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $action  Die auszuführende API-Funktion
     * @param  null|array  $params  Parameter, die bei den Funktionsaufrufen mitgeschickt werden sollen (optional)
     * @param  null|string  $batchParams  Parameter, die bei den Funktionsaufrufen mitgeschickt werden sollen (optional)
     * @param  string  $dateStarted  Datum, zu dem der Massenauftrag gestartet werden soll
     */
    public function __construct(
        protected string $action,
        protected ?array $params,
        protected ?string $batchParams,
        protected string $dateStarted,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'action' => $this->action,
            'params' => $this->params,
            'batchParams' => $this->batchParams,
            'dateStarted' => $this->dateStarted,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/batch/create';
    }
}
