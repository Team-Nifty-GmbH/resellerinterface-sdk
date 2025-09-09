<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Auth;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Section;
use TeamNiftyGmbH\ResellerInterface\Enums\TwoFaMethod;

/**
 * post_auth_update
 *
 * Aktualisiert die Informationen zu einem TwoFA-Bereich<br /><br /><a target="_blank"
 * href="/core/api#auth/update">In Reseller-Interface öffnen</a>
 */
class AuthUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     * @param  Section  $section  Welche Bereiche sollen durch TwoFA gesichert werden
     */
    public function __construct(
        protected ?int $userId,
        protected TwoFaMethod $twoFaMethod,
        protected Section $section,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId, 'TwoFaMethod' => $this->twoFaMethod->value, 'section' => $this->section->value]);
    }

    public function resolveEndpoint(): string
    {
        return '/auth/update';
    }
}
