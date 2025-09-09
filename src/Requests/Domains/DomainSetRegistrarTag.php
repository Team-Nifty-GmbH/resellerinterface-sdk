<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_domain_setRegistrarTag
 *
 * Ändern des Registrar-TAGs bei Transfer-Push<br /><br />Benötigte Rechte:<br />**Domains
 * kündigen** (api.domain.delete)<br /><br /><a target="_blank"
 * href="/core/api#domain/setRegistrarTag">In Reseller-Interface öffnen</a>
 */
class DomainSetRegistrarTag extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $registrarTag  Registrar-TAG
     */
    public function __construct(
        protected int $domain,
        protected string $registrarTag,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'registrarTag' => $this->registrarTag]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/setRegistrarTag';
    }
}
