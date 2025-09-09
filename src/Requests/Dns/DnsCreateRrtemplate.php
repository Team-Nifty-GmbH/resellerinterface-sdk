<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Dns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_dns_createRRTemplate
 *
 * Erstellt eine neues Resource-Record-Template<br /><br />Benötigte Rechte:<br />**Resourcentemplates
 * verwalten** (api.rrtemplate.manage)<br /><br /><a target="_blank"
 * href="/core/api#dns/createRRTemplate">In Reseller-Interface öffnen</a>
 */
class DnsCreateRrtemplate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $name  Name des Resource-Record-Templates (optional)
     */
    public function __construct(
        protected ?string $name = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['name' => $this->name]);
    }

    public function resolveEndpoint(): string
    {
        return '/dns/createRRTemplate';
    }
}
