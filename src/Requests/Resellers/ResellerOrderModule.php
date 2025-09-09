<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_orderModule
 *
 * Bestellt ein Modul<br /><br />Benötigte Rechte:<br />**Reseller-Zusatzmodule bestellen**
 * (api.resellerModule.order)<br /><br /><a target="_blank" href="/core/api#reseller/orderModule">In
 * Reseller-Interface öffnen</a>
 */
class ResellerOrderModule extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $name  Modul
     */
    public function __construct(
        protected string $name,
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
        return '/reseller/orderModule';
    }
}
