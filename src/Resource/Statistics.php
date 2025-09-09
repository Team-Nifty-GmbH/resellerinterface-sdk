<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Mode;
use TeamNiftyGmbH\ResellerInterface\Enums\Period;
use TeamNiftyGmbH\ResellerInterface\Enums\Tld;
use TeamNiftyGmbH\ResellerInterface\Requests\Statistics\StatsDomainAccess;
use TeamNiftyGmbH\ResellerInterface\Requests\Statistics\StatsDomains;

class Statistics extends BaseResource
{
    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  Period  $period  Zeitraum
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function statsDomainAccess(int $domain, Period $period): Response
    {
        return $this->connector->send(new StatsDomainAccess($domain, $period));
    }

    /**
     * @param  Mode  $mode  Modus
     * @param  Tld  $tld  Toplevel
     * @param  Period  $period  Zeitraum
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function statsDomains(Mode $mode, Tld $tld, Period $period): Response
    {
        return $this->connector->send(new StatsDomains($mode, $tld, $period));
    }
}
