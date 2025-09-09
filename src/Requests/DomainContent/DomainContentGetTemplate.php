<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domainContent_getTemplate
 *
 * Fragt Informationen zu einen Content-Template ab<br /><br />Benötigte Rechte:<br
 * />**ContentTemplates verwalten** (api.dns.manageContentTemplates)<br /><br /><a target="_blank"
 * href="/core/api#domainContent/getTemplate">In Reseller-Interface öffnen</a>
 */
class DomainContentGetTemplate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     */
    public function __construct(
        protected string $type,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['type' => $this->type]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainContent/getTemplate';
    }
}
