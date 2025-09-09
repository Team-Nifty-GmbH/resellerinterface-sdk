<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_deleteRRTemplateRecord
 *
 * Löscht einen bestehenden Resource-Record aus einem Resource-Record-Template<br /><br />Benötigte
 * Rechte:<br />**Resourcentemplates verwalten** (api.rrtemplate.manage)<br /><br /><a target="_blank"
 * href="/core/api#dns/deleteRRTemplateRecord">In Reseller-Interface öffnen</a>
 */
class DnsDeleteRrtemplateRecord extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $rrtemplateRecordId  Resource-Record-ID
     */
    public function __construct(
        protected int $rrtemplateRecordId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['RRTemplateRecordID' => $this->rrtemplateRecordId]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/deleteRRTemplateRecord';
    }
}
