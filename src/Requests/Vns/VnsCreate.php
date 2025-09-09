<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Vns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_vns_create
 *
 * Erstellt ein neues Set virtueller Nameserver<br /><br />Benötigte Rechte:<br />**Virtuelle
 * Nameserver verwalten** (api.vns.manage)<br /><br /><a target="_blank" href="/core/api#vns/create">In
 * Reseller-Interface öffnen</a>
 */
class VnsCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  string  $soaMail  E-Mail-Adresse der Verantwortlichen für die Zone
     * @param  array  $nameserver  Liste an Domains, die als virtuelle Nameserver verwendet werden sollen
     */
    public function __construct(
        protected ?int $resellerId,
        protected string $soaMail,
        protected array $nameserver,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId, 'soaMail' => $this->soaMail, 'nameserver' => $this->nameserver]);
    }

    public function resolveEndpoint(): string
    {
        return '/vns/create';
    }
}
