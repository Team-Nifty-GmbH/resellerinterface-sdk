<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_createPricelist
 *
 * Erstellt eine neue Preisliste<br /><br />Benötigte Rechte:<br />**Reseller-Preisverwaltung**
 * (api.reseller.prices)<br /><br /><a target="_blank"
 * href="/core/api#resellerPrices/createPricelist">In Reseller-Interface öffnen</a>
 */
class ResellerPricesCreatePricelist extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $name  Preislisten-Name
     */
    public function __construct(
        protected int $name,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['name' => $this->name]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/createPricelist';
    }
}
