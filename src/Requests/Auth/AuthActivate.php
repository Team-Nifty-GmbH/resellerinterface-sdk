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
 * post_auth_activate
 *
 * Aktiviert eine TwoFA für einen Bereich<br>
 * • Sollte die TwoFA bereits aktiv sein, wird die
 * vorhandene überschrieben und die bisherige verliert ihre Gültigkeit.<br>
 * • Aktivieren kann dies
 * nur der Benutzer selbst oder der Haupt-Benutzer (main).<br>
 * • Solltest Du sich mit dem
 * Haupt-Benutzer (main) nicht mehr authentifizieren können, wende Dich an Deinen Ober-Reseller
 * (parent).<br /><br /><a target="_blank" href="/core/api#auth/activate">In Reseller-Interface
 * öffnen</a>
 */
class AuthActivate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $userId  Benutzer-ID
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     * @param  Section  $section  Welche Bereiche sollen durch TwoFA gesichert werden
     * @param  TwoFaMethod  $value  Werte für die TwoFA-Methode
     */
    public function __construct(
        protected int $userId,
        protected TwoFaMethod $twoFaMethod,
        protected Section $section,
        protected TwoFaMethod $value,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'userID' => $this->userId,
            'TwoFaMethod' => $this->twoFaMethod->value,
            'section' => $this->section->value,
            'value' => $this->value->value,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/auth/activate';
    }
}
