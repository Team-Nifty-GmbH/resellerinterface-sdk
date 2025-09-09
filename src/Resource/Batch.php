<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchDetailsTask;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchList;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchListTasks;
use TeamNiftyGmbH\ResellerInterface\Requests\Batch\BatchUpdate;

class Batch extends BaseResource
{
    /**
     * @param  string  $action  Die auszuführende API-Funktion
     * @param  null|array  $params  Parameter, die bei den Funktionsaufrufen mitgeschickt werden sollen (optional)
     * @param  null|string  $batchParams  Parameter, die bei den Funktionsaufrufen mitgeschickt werden sollen (optional)
     * @param  string  $dateStarted  Datum, zu dem der Massenauftrag gestartet werden soll
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchCreate(
        string $action,
        ?array $params,
        ?string $batchParams,
        string $dateStarted,
    ): Response {
        return $this->connector->send(new BatchCreate($action, $params, $batchParams, $dateStarted));
    }

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchDelete(int $batchProcessingId): Response
    {
        return $this->connector->send(new BatchDelete($batchProcessingId));
    }

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchDetails(int $batchProcessingId): Response
    {
        return $this->connector->send(new BatchDetails($batchProcessingId));
    }

    /**
     * @param  int  $batchProcessingTaskId  Massenauftrag-Task-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchDetailsTask(int $batchProcessingTaskId): Response
    {
        return $this->connector->send(new BatchDetailsTask($batchProcessingTaskId));
    }

    /**
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchList(
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new BatchList($search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchListTasks(
        int $batchProcessingId,
        ?string $search = null,
        ?array $filter = null,
        ?int $offset = null,
        ?int $limit = null,
        ?bool $csv = null,
    ): Response {
        return $this->connector->send(new BatchListTasks($batchProcessingId, $search, $filter, $offset, $limit, $csv));
    }

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     * @param  string  $dateStarted  Datum, zu dem der Massenauftrag gestartet werden soll
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function batchUpdate(int $batchProcessingId, string $dateStarted): Response
    {
        return $this->connector->send(new BatchUpdate($batchProcessingId, $dateStarted));
    }
}
