<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_setRecords
 *
 * <br /><br />Benötigte Rechte:<br />**Zonenrecords (RR) verwalten** (api.dns.manageRecords)<br /><br
 * /><a target="_blank" href="/core/api#dns/setRecords">In Reseller-Interface öffnen</a>
 */
class DnsSetRecords extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|bool  $clearZone  Zone vor Anwendung löschen (optional)
     * @param  null|bool  $backupZone  Backup der Zone vor Anwendung erstellen (optional)
     * @param  array  $records  [[dns/updateRecord](#post-/dns/updateRecord)]
     */
    public function __construct(
        protected string $domain,
        protected ?bool $clearZone,
        protected ?bool $backupZone,
        protected array $records,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'clearZone' => $this->clearZone,
            'backupZone' => $this->backupZone,
            'records' => $this->records,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/setRecords';
    }
}
