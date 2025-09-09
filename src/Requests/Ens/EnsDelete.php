<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ens;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_ens_delete
 *
 * <br /><br />Benötigte Rechte:<br />**Virtuelle Nameserver verwalten** (api.vns.manage)<br /><br
 * /><a target="_blank" href="/core/api#ens/delete">In Reseller-Interface öffnen</a>
 */
class EnsDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $ensId  ID eines externen Nameserver-Sets
     */
    public function __construct(
        protected int $ensId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['ensID' => $this->ensId]);
    }

    public function resolveEndpoint(): string
    {
        return '/ens/delete';
    }
}
