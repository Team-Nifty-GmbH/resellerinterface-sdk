<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\FlexDns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_flexdns_list
 *
 * Listet Flex-DNS-Benutzer auf<br /><br />Benötigte Rechte:<br />**FlexDNS-Benutzer verwalten**
 * (api.flexdns.manage)<br /><br /><a target="_blank" href="/core/api#flexdns/list">In
 * Reseller-Interface öffnen</a>
 */
class FlexdnsList extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     * @param  null|string  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     */
    public function __construct(
        protected ?int $offset = null,
        protected ?int $limit = null,
        protected ?string $search = null,
        protected ?array $filter = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['offset' => $this->offset, 'limit' => $this->limit, 'search' => $this->search, 'filter' => $this->filter]);
    }

    public function resolveEndpoint(): string
    {
        return '/flexdns/list';
    }
}
