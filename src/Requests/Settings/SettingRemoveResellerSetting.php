<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Settings;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_setting_removeResellerSetting
 *
 * Entfernt eine Einstellung<br /><br />Benötigte Rechte:<br />**Unterreseller verwalten**
 * (api.reseller.manage)<br /><br /><a target="_blank"
 * href="/core/api#setting/removeResellerSetting">In Reseller-Interface öffnen</a>
 */
class SettingRemoveResellerSetting extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     * @param  string  $group  Gruppe der Einstellung
     * @param  string  $name  Name der Einstellung
     */
    public function __construct(
        protected ?string $resellerId,
        protected string $group,
        protected string $name,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId, 'group' => $this->group, 'name' => $this->name]);
    }

    public function resolveEndpoint(): string
    {
        return '/setting/removeResellerSetting';
    }
}
