<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\FlexDns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_flexdns_updateDNS
 *
 * Updated die Zonen eines Flex-DNS-Benutzers<br /><br /><a target="_blank"
 * href="/core/api#flexdns/updateDNS">In Reseller-Interface öffnen</a>
 */
class FlexdnsUpdateDns extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $ipv4  IPv4-Adresse (optional)
     * @param  null|string  $ipv6  IPv6-Adresse (optional)
     */
    public function __construct(
        protected ?string $ipv4 = null,
        protected ?string $ipv6 = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['IPv4' => $this->ipv4, 'IPv6' => $this->ipv6]);
    }

    public function resolveEndpoint(): string
    {
        return '/flexdns/updateDNS';
    }
}
