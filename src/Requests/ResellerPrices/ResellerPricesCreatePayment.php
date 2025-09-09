<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\ResellerPrices;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_resellerPrices_createPayment
 *
 * <br /><br />Benötigte Rechte:<br />**Reseller-Preisverwaltung** (api.reseller.prices)<br /><br /><a
 * target="_blank" href="/core/api#resellerPrices/createPayment">In Reseller-Interface öffnen</a>
 */
class ResellerPricesCreatePayment extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  array  $resellerId  Reseller-ID
     * @param  string  $amount  Betrag
     * @param  string  $reference  Zusammenfassung
     * @param  null|string  $dateValuta  (optional)
     */
    public function __construct(
        protected array $resellerId,
        protected string $amount,
        protected string $reference,
        protected ?string $dateValuta = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'resellerID' => $this->resellerId,
            'amount' => $this->amount,
            'reference' => $this->reference,
            'dateValuta' => $this->dateValuta,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/resellerPrices/createPayment';
    }
}
