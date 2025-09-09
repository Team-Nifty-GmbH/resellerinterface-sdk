<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\DomainContent;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domainContent_setTemplate
 *
 * Setzt ein Content-Template<br /><br />Benötigte Rechte:<br />**ContentTemplates verwalten**
 * (api.dns.manageContentTemplates)<br /><br /><a target="_blank"
 * href="/core/api#domainContent/setTemplate">In Reseller-Interface öffnen</a>
 */
class DomainContentSetTemplate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  array  $data  Content-Daten
     */
    public function __construct(
        protected string $type,
        protected array $data,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['type' => $this->type, 'data' => $this->data]);
    }

    public function resolveEndpoint(): string
    {
        return '/domainContent/setTemplate';
    }
}
