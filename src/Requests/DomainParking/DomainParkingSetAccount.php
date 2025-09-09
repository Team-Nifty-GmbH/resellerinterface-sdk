<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainParking;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Vendor;

/**
 * post_domainParking_setAccount
 *
 * Speichert einen Domain-Parking-Anbieter Account<br /><br />Benötigte Rechte:<br />**Domains
 * verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domainParking/setAccount">In Reseller-Interface öffnen</a>
 */
class DomainParkingSetAccount extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  Vendor  $vendor  Parkingprovider
     * @param  array  $credentials  Die Zugangsdaten als Array
     */
    public function __construct(
        protected Vendor $vendor,
        protected array $credentials,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['vendor' => $this->vendor->value, 'credentials' => $this->credentials]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainParking/setAccount';
    }
}
