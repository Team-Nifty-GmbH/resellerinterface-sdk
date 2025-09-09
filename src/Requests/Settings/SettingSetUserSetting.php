<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Settings;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\SubresellerInheritanceMode;

/**
 * post_setting_setUserSetting
 *
 * Setzt eine Benutzer-Einstellung<br /><br />Benötigte Rechte:<br />**Unterbenutzer verwalten**
 * (api.user.manage)<br /><br /><a target="_blank" href="/core/api#setting/setUserSetting">In
 * Reseller-Interface öffnen</a>
 */
class SettingSetUserSetting extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     * @param  string  $value  Wert
     * @param  null|bool  $forced  Festgelegter Wert wird genutzt, auch wenn durch Vererbung eigentlich nicht änderbar.
     *                             Einstellung wird auf "readonly" gesetzt.
     *                             Kann nur vom direkten Ober-Reseller (parent) verwaltet werden, sofern dieser Schreibrechte für diese Einstellung hat. (optional)
     * @param  null|SubresellerInheritanceMode  $subuserInheritanceMode  Art der Vererbung (optional)
     * @param  null|string  $subuserInheritanceModeCustomValue  Wert der Vererbung (optional)
     */
    public function __construct(
        protected ?string $userId,
        protected string $group,
        protected string $name,
        protected string $value,
        protected ?bool $forced = null,
        protected ?SubresellerInheritanceMode $subuserInheritanceMode = null,
        protected ?string $subuserInheritanceModeCustomValue = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'userID' => $this->userId,
            'group' => $this->group,
            'name' => $this->name,
            'value' => $this->value,
            'forced' => $this->forced,
            'subuserInheritanceMode' => $this->subuserInheritanceMode?->value,
            'subuserInheritanceModeCustomValue' => $this->subuserInheritanceModeCustomValue,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/setting/setUserSetting';
    }
}
