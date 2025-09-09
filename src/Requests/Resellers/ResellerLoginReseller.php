<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;

/**
 * post_reseller_loginReseller
 *
 * In einen Sub-Reseller (child) wechseln<br /><br />Benötigte Rechte:<br />**Unterreseller
 * verwalten** (api.reseller.manage)<br /><br /><a target="_blank"
 * href="/core/api#reseller/loginReseller">In Reseller-Interface öffnen</a>
 */
class ResellerLoginReseller extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $resellerId  Reseller-ID
     */
    public function __construct(
        protected int $resellerId,
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
        return '/reseller/loginReseller';
    }
}
