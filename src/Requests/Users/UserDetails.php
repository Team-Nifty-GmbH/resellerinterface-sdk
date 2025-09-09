<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Users;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\User;

/**
 * post_user_details
 *
 * Detailierte Informationen zu einem Benutzer<br /><br />Benötigte Rechte:<br />**Unterbenutzer
 * einsehen** (api.user.view)<br /><br /><a target="_blank" href="/core/api#user/details">In
 * Reseller-Interface öffnen</a>
 */
class UserDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $userId  Benutzer-ID
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
        return '/user/details';
    }
}
