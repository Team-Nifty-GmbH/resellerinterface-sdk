<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_delete
 *
 * Löscht einen Reseller<br /><br />Optionale Rechte:<br />**Unterreseller verwalten**
 * (api.reseller.manage)<br />**Eigene Resellerdaten verwalten** (api.reseller.manageSelf)<br /><br
 * /><a target="_blank" href="/core/api#reseller/delete">In Reseller-Interface öffnen</a>
 */
class ResellerDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     */
    public function __construct(
        protected ?string $resellerId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/delete';
    }
}
