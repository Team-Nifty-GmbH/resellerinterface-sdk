<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainParking;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Vendor;

/**
 * post_domainParking_insert
 *
 * Schaltet eine Domain auf den Domain-Parking-Anbieter<br /><br />Benötigte Rechte:<br />**Domains
 * verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domainParking/insert">In Reseller-Interface öffnen</a>
 */
class DomainParkingInsert extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  Vendor  $vendor  Parkingprovider
     */
    public function __construct(
        protected int $domain,
        protected Vendor $vendor,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'vendor' => $this->vendor->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainParking/insert';
    }
}
