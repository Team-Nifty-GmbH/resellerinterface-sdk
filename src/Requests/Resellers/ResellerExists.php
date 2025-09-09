<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_exists
 *
 * Prüft ob der Benutzername bei einem Sub-Reseller (child) bereits verwendet wird<br /><br
 * />Benötigte Rechte:<br />**Unterreseller verwalten** (api.reseller.manage)<br /><br /><a
 * target="_blank" href="/core/api#reseller/exists">In Reseller-Interface öffnen</a>
 */
class ResellerExists extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $username  Benutzername
     */
    public function __construct(
        protected string $username,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['username' => $this->username]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/exists';
    }
}
