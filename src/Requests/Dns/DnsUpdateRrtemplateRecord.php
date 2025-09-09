<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\RedirectCode;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_dns_updateRRTemplateRecord
 *
 * Bearbeitet ein bestehenden Resource-Record eines Resource-Record-Templates<br /><br />Benötigte
 * Rechte:<br />**Resourcentemplates verwalten** (api.rrtemplate.manage)<br /><br /><a target="_blank"
 * href="/core/api#dns/updateRRTemplateRecord">In Reseller-Interface öffnen</a>
 */
class DnsUpdateRrtemplateRecord extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $rrtemplateRecordId  Resource-Record-ID
     * @param  null|string  $name  Resource-Name (optional)
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     * @param  Type  $type  Resource-Typ
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
        protected int $rrtemplateRecordId,
        protected ?string $name,
        protected ?int $ttl,
        protected Type $type,
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
            'RRTemplateRecordID' => $this->rrtemplateRecordId,
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
        return '/dns/updateRRTemplateRecord';
    }
}
