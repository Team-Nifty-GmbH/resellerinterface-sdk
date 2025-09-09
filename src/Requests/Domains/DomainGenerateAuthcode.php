<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\ExpireDays;

/**
 * post_domain_generateAuthcode
 *
 * Generiert einen Authcode für eine Domain<br /><br />Benötigte Rechte:<br />**Domains kündigen**
 * (api.domain.delete)<br /><br /><a target="_blank" href="/core/api#domain/generateAuthcode">In
 * Reseller-Interface öffnen</a>
 */
class DomainGenerateAuthcode extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|ExpireDays  $expireDays  Authcode-Gültigkeit in Tagen (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?ExpireDays $expireDays = null,
        protected ?bool $waitForResponse = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'expireDays' => $this->expireDays?->value, 'waitForResponse' => $this->waitForResponse]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/generateAuthcode';
    }
}
