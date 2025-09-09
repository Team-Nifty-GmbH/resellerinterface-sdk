<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\FlexDns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;

/**
 * post_flexdns_create
 *
 * Erstellt einen Flex-DNS-Benutzer<br /><br />Benötigte Rechte:<br />**FlexDNS-Benutzer verwalten**
 * (api.flexdns.manage)<br /><br /><a target="_blank" href="/core/api#flexdns/create">In
 * Reseller-Interface öffnen</a>
 */
class FlexdnsCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $category  Kategorie (optional)
     */
    public function __construct(
        protected ?string $category = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['category' => $this->category]);
    }

    public function resolveEndpoint(): string
    {
        return '/flexdns/create';
    }
}
