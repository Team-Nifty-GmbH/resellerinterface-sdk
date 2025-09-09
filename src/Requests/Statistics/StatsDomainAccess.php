<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Statistics;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Period;

/**
 * post_stats_domainAccess
 *
 * Fragt die Domain-Besucherstatistiken ab<br /><br />Benötigte Rechte:<br />**Statistiken einsehen**
 * (api.stats.view)<br /><br /><a target="_blank" href="/core/api#stats/domainAccess">In
 * Reseller-Interface öffnen</a>
 */
class StatsDomainAccess extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  Period  $period  Zeitraum
     */
    public function __construct(
        protected int $domain,
        protected Period $period,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'period' => $this->period->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/stats/domainAccess';
    }
}
