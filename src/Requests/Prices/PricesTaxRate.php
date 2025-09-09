<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Prices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_prices_taxRate
 *
 * Fragt den verwendeten Steuersatz ab<br /><br /><a target="_blank" href="/core/api#prices/taxRate">In
 * Reseller-Interface öffnen</a>
 */
class PricesTaxRate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $productGroup  Produkt-Gruppe (optional)
     * @param  null|string  $productName  Produktname (optional)
     * @param  null|string  $date  Datum (optional)
     */
    public function __construct(
        protected ?string $productGroup = null,
        protected ?string $productName = null,
        protected ?string $date = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['productGroup' => $this->productGroup, 'productName' => $this->productName, 'date' => $this->date]);
    }

    public function resolveEndpoint(): string
    {
        return '/prices/taxRate';
    }
}
