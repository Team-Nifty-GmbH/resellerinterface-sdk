<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerOrderGroupName;

/**
 * post_reseller_orderGroup
 *
 * Bestellt ein Reseller-Paket<br /><br />Benötigte Rechte:<br />**Reseller-Zusatzmodule bestellen**
 * (api.resellerModule.order)<br /><br /><a target="_blank" href="/core/api#reseller/orderGroup">In
 * Reseller-Interface öffnen</a>
 */
class ResellerOrderGroup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  ResellerOrderGroupName  $name  Reseller-Paket
     */
    public function __construct(
        protected ResellerOrderGroupName $name,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['name' => $this->name->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/orderGroup';
    }
}
