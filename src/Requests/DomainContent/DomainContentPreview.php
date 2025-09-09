<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domainContent_preview
 *
 * Generiert eine Vorschau des Contents<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR)
 * verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#domainContent/preview">In Reseller-Interface öffnen</a>
 */
class DomainContentPreview extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domainId  Domain-ID
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  null|array  $data  Content-Daten (optional)
     * @param  null|int  $cardId  Web-Visitenkarten-ID (optional)
     * @param  null|int  $sellId  Verkaufsagent-ID (optional)
     */
    public function __construct(
        protected int $domainId,
        protected string $type,
        protected ?array $data = null,
        protected ?int $cardId = null,
        protected ?int $sellId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domainID' => $this->domainId,
            'type' => $this->type,
            'data' => $this->data,
            'card_id' => $this->cardId,
            'sell_id' => $this->sellId,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainContent/preview';
    }
}
