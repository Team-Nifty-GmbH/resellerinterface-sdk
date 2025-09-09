<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Maintenance;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_maintenance_details
 *
 * Ruft Informationen zu einer bestehenden Wartungsmeldung ab<br /><br /><a target="_blank"
 * href="/core/api#maintenance/details">In Reseller-Interface öffnen</a>
 */
class MaintenanceDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $maintenanceEntryId  Wartungs-ID
     */
    public function __construct(
        protected int $maintenanceEntryId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['maintenanceEntryID' => $this->maintenanceEntryId]);
    }

    public function resolveEndpoint(): string
    {
        return '/maintenance/details';
    }
}
