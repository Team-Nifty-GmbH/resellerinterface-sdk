<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ens;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_ens_create
 *
 * <br /><br />Benötigte Rechte:<br />**Virtuelle Nameserver verwalten** (api.vns.manage)<br /><br
 * /><a target="_blank" href="/core/api#ens/create">In Reseller-Interface öffnen</a>
 */
class EnsCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  array  $nameserver  Nameserver
     */
    public function __construct(
        protected ?int $resellerId,
        protected array $nameserver,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId, 'nameserver' => $this->nameserver]);
    }

    public function resolveEndpoint(): string
    {
        return '/ens/create';
    }
}
