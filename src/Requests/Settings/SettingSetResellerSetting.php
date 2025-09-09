<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Settings;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\SubresellerInheritanceMode;

/**
 * post_setting_setResellerSetting
 *
 * Setzt eine Reseller-Einstellung<br /><br />Benötigte Rechte:<br />**Unterreseller verwalten**
 * (api.reseller.manage)<br /><br /><a target="_blank" href="/core/api#setting/setResellerSetting">In
 * Reseller-Interface öffnen</a>
 */
class SettingSetResellerSetting extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     * @param  string  $value  Wert
     * @param  null|bool  $forced  Festgelegter Wert wird genutzt, auch wenn durch Vererbung eigentlich nicht änderbar.
     *                             Einstellung wird auf "readonly" gesetzt.
     *                             Kann nur vom direkten Ober-Reseller (parent) verwaltet werden, sofern dieser Schreibrechte für diese Einstellung hat. (optional)
     * @param  null|SubresellerInheritanceMode  $subresellerInheritanceMode  Art der Vererbung (optional)
     * @param  null|string  $subresellerInheritanceModeCustomValue  Wert der Vererbung (optional)
     */
    public function __construct(
        protected ?string $resellerId,
        protected string $group,
        protected string $name,
        protected string $value,
        protected ?bool $forced = null,
        protected ?SubresellerInheritanceMode $subresellerInheritanceMode = null,
        protected ?string $subresellerInheritanceModeCustomValue = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'resellerID' => $this->resellerId,
            'group' => $this->group,
            'name' => $this->name,
            'value' => $this->value,
            'forced' => $this->forced,
            'subresellerInheritanceMode' => $this->subresellerInheritanceMode?->value,
            'subresellerInheritanceModeCustomValue' => $this->subresellerInheritanceModeCustomValue,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/setting/setResellerSetting';
    }
}
