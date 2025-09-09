<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_updateRRTemplate
 *
 * Bearbeitet ein bestehendes Resource-Record-Template<br /><br />Benötigte Rechte:<br
 * />**Resourcentemplates verwalten** (api.rrtemplate.manage)<br /><br /><a target="_blank"
 * href="/core/api#dns/updateRRTemplate">In Reseller-Interface öffnen</a>
 */
class DnsUpdateRrtemplate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     * @param  null|string  $name  Name des Resource-Record-Templates (optional)
     */
    public function __construct(
        protected int $rrtemplateId,
        protected ?string $name = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['RRTemplateID' => $this->rrtemplateId, 'name' => $this->name]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/updateRRTemplate';
    }
}
