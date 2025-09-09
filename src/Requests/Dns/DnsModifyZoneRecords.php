<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Mode;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_dns_modifyZoneRecords
 *
 * Ändert Resource-Records einer Zone ab<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR)
 * verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#dns/modifyZoneRecords">In Reseller-Interface öffnen</a>
 */
class DnsModifyZoneRecords extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  Mode  $mode  Resource-Records anlegen, ersetzen oder löschen
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  null|Type  $type  Resource-Typ (optional)
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  null|string  $content  Resource-Data (optional)
     * @param  null|string  $matchContent  Alte Resource-Data (optional)
     * @param  null|string  $soaMail  E-Mail-Adresse der Verantwortlichen für die Zone (optional)
     */
    public function __construct(
        protected string $domain,
        protected Mode $mode,
        protected ?string $name = null,
        protected ?int $ttl = null,
        protected ?Type $type = null,
        protected ?int $priority = null,
        protected ?string $content = null,
        protected ?string $matchContent = null,
        protected ?string $soaMail = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'mode' => $this->mode->value,
            'name' => $this->name,
            'ttl' => $this->ttl,
            'type' => $this->type?->value,
            'priority' => $this->priority,
            'content' => $this->content,
            'matchContent' => $this->matchContent,
            'soaMail' => $this->soaMail,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/modifyZoneRecords';
    }
}
