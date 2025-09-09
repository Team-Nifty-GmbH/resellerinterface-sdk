<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_detailsRRTemplate
 *
 * Ruft die Informationen zu einen bestehenden Resource-Record-Template ab<br /><br />Benötigte
 * Rechte:<br />**Resourcentemplates verwalten** (api.rrtemplate.manage)<br /><br /><a target="_blank"
 * href="/core/api#dns/detailsRRTemplate">In Reseller-Interface öffnen</a>
 */
class DnsDetailsRrtemplate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $rrtemplateId  Resource-Record-Template-ID
     */
    public function __construct(
        protected int $rrtemplateId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['RRTemplateID' => $this->rrtemplateId]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/detailsRRTemplate';
    }
}
