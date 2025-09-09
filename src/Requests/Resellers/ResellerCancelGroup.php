<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_cancelGroup
 *
 * Kündigt ein Reseller-Paket<br /><br />Benötigte Rechte:<br />**Reseller-Zusatzmodule kündigen**
 * (api.resellerModule.delete)<br /><br /><a target="_blank" href="/core/api#reseller/cancelGroup">In
 * Reseller-Interface öffnen</a>
 */
class ResellerCancelGroup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $reason  Grund der Kündigung (optional)
     */
    public function __construct(
        protected ?string $reason = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['reason' => $this->reason]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/cancelGroup';
    }
}
