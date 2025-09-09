<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\FlexDns;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;

/**
 * post_flexdns_passwordChange
 *
 * <br /><br />Benötigte Rechte:<br />**FlexDNS-Benutzer verwalten** (api.flexdns.manage)<br /><br
 * /><a target="_blank" href="/core/api#flexdns/passwordChange">In Reseller-Interface öffnen</a>
 */
class FlexdnsPasswordChange extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $userId  Flex-DNS-Benutzer-ID
     */
    public function __construct(
        protected int $userId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return User::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId]);
    }

    public function resolveEndpoint(): string
    {
        return '/flexdns/passwordChange';
    }
}
