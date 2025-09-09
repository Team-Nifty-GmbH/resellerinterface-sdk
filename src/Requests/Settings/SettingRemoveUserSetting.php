<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Settings;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_setting_removeUserSetting
 *
 * Löscht eine Benutzer-Einstellung<br /><br />Benötigte Rechte:<br />**Unterbenutzer verwalten**
 * (api.user.manage)<br /><br /><a target="_blank" href="/core/api#setting/removeUserSetting">In
 * Reseller-Interface öffnen</a>
 */
class SettingRemoveUserSetting extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     */
    public function __construct(
        protected ?string $userId,
        protected string $group,
        protected string $name,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId, 'group' => $this->group, 'name' => $this->name]);
    }

    public function resolveEndpoint(): string
    {
        return '/setting/removeUserSetting';
    }
}
