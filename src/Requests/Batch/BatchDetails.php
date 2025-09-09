<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Batch;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_batch_details
 *
 * Ruft Informationen zu einem Massenauftrag ab<br /><br />Benötigte Rechte:<br />**Massenaufträge
 * einsehen** (api.batchProcessing.view)<br /><br /><a target="_blank"
 * href="/core/api#batch/details">In Reseller-Interface öffnen</a>
 */
class BatchDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $batchProcessingId  Die ID des Massenauftrags
     */
    public function __construct(
        protected int $batchProcessingId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['batchProcessingID' => $this->batchProcessingId]);
    }

    public function resolveEndpoint(): string
    {
        return '/batch/details';
    }
}
