<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;

/**
 * post_reseller_details
 *
 * Detailierte Informationen zu einem Reseller<br /><br />Benötigte Rechte:<br />**Unterreseller
 * einsehen** (api.reseller.view)<br /><br /><a target="_blank" href="/core/api#reseller/details">In
 * Reseller-Interface öffnen</a>
 */
class ResellerDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     */
    public function __construct(
        protected ?int $resellerId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Reseller::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/details';
    }
}
