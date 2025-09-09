<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\TwoFaMethod;

/**
 * post_domain_authDomainSafe
 *
 * Aktiviert einen TwoFA-Methode für den Domain-Safe<br /><br />Benötigte Rechte:<br />**Domain-Safe
 * verwalten** (api.domain.domainSafe)<br /><br /><a target="_blank"
 * href="/core/api#domain/authDomainSafe">In Reseller-Interface öffnen</a>
 */
class DomainAuthDomainSafe extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     * @param  bool  $temp  Temporär
     * @param  array  $value  Werte für die TwoFA-Methode
     */
    public function __construct(
        protected TwoFaMethod $twoFaMethod,
        protected bool $temp,
        protected array $value,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['TwoFaMethod' => $this->twoFaMethod->value, 'temp' => $this->temp, 'value' => $this->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/authDomainSafe';
    }
}
