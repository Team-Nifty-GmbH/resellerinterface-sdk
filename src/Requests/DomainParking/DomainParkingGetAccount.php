<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainParking;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Vendor;

/**
 * post_domainParking_getAccount
 *
 * Fragt den Account für einen Domain-Parking-Anbieter ab<br /><br />Benötigte Rechte:<br />**Domains
 * verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domainParking/getAccount">In Reseller-Interface öffnen</a>
 */
class DomainParkingGetAccount extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  Vendor  $vendor  Parkingprovider
     */
    public function __construct(
        protected Vendor $vendor,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['vendor' => $this->vendor->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainParking/getAccount';
    }
}
