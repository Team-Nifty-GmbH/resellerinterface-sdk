<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Statistics;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Mode;
use TeamNiftyGmbH\ResellerInterface\Enums\Period;
use TeamNiftyGmbH\ResellerInterface\Enums\Tld;

/**
 * post_stats_domains
 *
 * Fragt die Domain-Statistiken ab<br /><br />Benötigte Rechte:<br />**Statistiken einsehen**
 * (api.stats.view)<br /><br /><a target="_blank" href="/core/api#stats/domains">In Reseller-Interface
 * öffnen</a>
 */
class StatsDomains extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  Mode  $mode  Modus
     * @param  Tld  $tld  Toplevel
     * @param  Period  $period  Zeitraum
     */
    public function __construct(
        protected Mode $mode,
        protected Tld $tld,
        protected Period $period,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['mode' => $this->mode->value, 'tld' => $this->tld->value, 'period' => $this->period->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/stats/domains';
    }
}
