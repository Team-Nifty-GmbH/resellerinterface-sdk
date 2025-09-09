<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_domainContent_set
 *
 * Setzt Content zu einer Domain<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR) verwalten**
 * (api.dns.manageRecords)<br /><br /><a target="_blank" href="/core/api#domainContent/set">In
 * Reseller-Interface öffnen</a>
 */
class DomainContentSet extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  Type  $type  Content-Typ
     * @param  null|array  $data  Content-Daten (optional)
     * @param  null|int  $cardId  Web-Visitenkarten-ID (optional)
     * @param  null|int  $sellId  Verkaufsagent-ID (optional)
     * @param  null|bool  $activate  aktivieren (optional)
     * @param  null|bool  $force  Aktivierung erzwingen (optional)
     */
    public function __construct(
        protected int $domain,
        protected Type $type,
        protected ?array $data = null,
        protected ?int $cardId = null,
        protected ?int $sellId = null,
        protected ?bool $activate = null,
        protected ?bool $force = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'type' => $this->type->value,
            'data' => $this->data,
            'card_id' => $this->cardId,
            'sell_id' => $this->sellId,
            'activate' => $this->activate,
            'force' => $this->force,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainContent/set';
    }
}
