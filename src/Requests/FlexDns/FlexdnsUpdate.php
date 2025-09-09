<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\FlexDns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;

/**
 * post_flexdns_update
 *
 * Aktualisiert einen FlexDNS-Benutzer<br /><br />Benötigte Rechte:<br />**FlexDNS-Benutzer
 * verwalten** (api.flexdns.manage)<br /><br /><a target="_blank" href="/core/api#flexdns/update">In
 * Reseller-Interface öffnen</a>
 */
class FlexdnsUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $userId  Flex-DNS-Benutzer-ID
     * @param  null|string  $category  Kategorie (optional)
     */
    public function __construct(
        protected int $userId,
        protected ?string $category = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId, 'category' => $this->category]);
    }

    public function resolveEndpoint(): string
    {
        return '/flexdns/update';
    }
}
