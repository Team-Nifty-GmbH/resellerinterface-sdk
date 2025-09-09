<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Vns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_vns_delete
 *
 * Einen virtuellen Nameserver löschen<br /><br />Benötigte Rechte:<br />**Virtuelle Nameserver
 * verwalten** (api.vns.manage)<br /><br /><a target="_blank" href="/core/api#vns/delete">In
 * Reseller-Interface öffnen</a>
 */
class VnsDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $vnsId  ID eines virtuellen Nameservers
     */
    public function __construct(
        protected int $vnsId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['vnsID' => $this->vnsId]);
    }

    public function resolveEndpoint(): string
    {
        return '/vns/delete';
    }
}
