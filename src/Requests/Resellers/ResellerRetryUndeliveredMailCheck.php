<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_retryUndeliveredMailCheck
 *
 * Verschickt erneut eine Prüfmail an die E-Mail-Adresse<br /><br /><a target="_blank"
 * href="/core/api#reseller/retryUndeliveredMailCheck">In Reseller-Interface öffnen</a>
 */
class ResellerRetryUndeliveredMailCheck extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $id  Undelivered-ID
     */
    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['id' => $this->id]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/retryUndeliveredMailCheck';
    }
}
