<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Reseller;
use TeamNiftyGmbH\ResellerInterface\Enums\SettingsMode;

/**
 * post_reseller_settings
 *
 * Ändert die Einstellungen eines Resellers<br>
 * • Eine Übersicht der zur Verfügung stehenden
 * Einstellungen kannst Du mit reseller/details abrufen.<br>
 * <br>
 * ACHTUNG: Mit der Option
 * "settingsMode=set" werden alle nicht mitgesendeten Settings auf den System-Default zurück
 * gesetzt.<br /><br />Benötigte Rechte:<br />**Unterreseller verwalten** (api.reseller.manage)<br
 * /><br /><a target="_blank" href="/core/api#reseller/settings">In Reseller-Interface öffnen</a>
 */
class ResellerSettings extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|SettingsMode  $settingsMode  Modus für die angegebenen Einstellungen (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listResellerSettings](#post-/setting/listResellerSettings)]
     */
    public function __construct(
        protected ?SettingsMode $settingsMode = null,
        protected ?array $settings = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Reseller::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['settingsMode' => $this->settingsMode?->value, 'settings' => $this->settings]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/settings';
    }
}
