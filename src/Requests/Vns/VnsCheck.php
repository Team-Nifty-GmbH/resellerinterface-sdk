<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Vns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_vns_check
 *
 * Prüft, ob die angegebenen Nameserver als virtuelle Nameserver verwendet werden können<br /><br
 * />Benötigte Rechte:<br />**Virtuelle Nameserver verwalten** (api.vns.manage)<br /><br /><a
 * target="_blank" href="/core/api#vns/check">In Reseller-Interface öffnen</a>
 */
class VnsCheck extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  array  $nameserver  Liste an Domains, die als virtuelle Nameserver verwendet werden sollen
     */
    public function __construct(
        protected array $nameserver,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['nameserver' => $this->nameserver]);
    }

    public function resolveEndpoint(): string
    {
        return '/vns/check';
    }
}
