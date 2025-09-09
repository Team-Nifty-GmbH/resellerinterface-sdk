<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainParking;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_domainParking_listAccounts
 *
 * Listet bestehende Domain-Parking-Anbieter Accounts auf<br /><br />Benötigte Rechte:<br />**Domains
 * verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domainParking/listAccounts">In Reseller-Interface öffnen</a>
 */
class DomainParkingListAccounts extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/domainParking/listAccounts';
    }
}
