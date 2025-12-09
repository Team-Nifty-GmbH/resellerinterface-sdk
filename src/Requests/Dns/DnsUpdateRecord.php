<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\DnsRecordType;
use TeamNiftyGmbH\ResellerInterface\Enums\RedirectCode;

/**
 * post_dns_updateRecord
 *
 * Ändert einen bestehenden Resource-Record<br /><br />Benötigte Rechte:<br />**Zonenrecords (RR)
 * verwalten** (api.dns.manageRecords)<br /><br /><a target="_blank"
 * href="/core/api#dns/updateRecord">In Reseller-Interface öffnen</a>
 */
class DnsUpdateRecord extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  int  $id  Record-ID
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  DnsRecordType  $type  Resource-Typ
     * @param  null|int  $priority  Resource-Priorität (optional)
     * @param  string  $content  Resource-Data
     * @param  null|string  $uri  Ziel URL der Frame-/Header-Weiterleitung (optional)
     * @param  null|RedirectCode  $redirectCode  HTTP-Statuscode für die Header-Weiterleitung (optional)
     * @param  null|string  $favicon  URL zum Favoriten-Symbol der Frame-Weiterleitung (optional)
     * @param  null|string  $title  Titeltext der Frame-Weiterleitung (optional)
     * @param  null|string  $desc  Beschreibungstext der Frame-Weiterleitung (optional)
     * @param  null|string  $keywords  Schlüsselwörter der Frame-Weiterleitung (optional)
     */
    public function __construct(
        protected string $domain,
        protected int $id,
        protected ?string $name,
        protected ?int $ttl,
        protected DnsRecordType $type,
        protected ?int $priority,
        protected string $content,
        protected ?string $uri = null,
        protected ?RedirectCode $redirectCode = null,
        protected ?string $favicon = null,
        protected ?string $title = null,
        protected ?string $desc = null,
        protected ?string $keywords = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'id' => $this->id,
            'name' => $this->name,
            'ttl' => $this->ttl,
            'type' => $this->type->value,
            'priority' => $this->priority,
            'content' => $this->content,
            'uri' => $this->uri,
            'redirectCode' => $this->redirectCode?->value,
            'favicon' => $this->favicon,
            'title' => $this->title,
            'desc' => $this->desc,
            'keywords' => $this->keywords,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/updateRecord';
    }
}
