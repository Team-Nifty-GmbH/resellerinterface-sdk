<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Settings;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_setting_listUserSettings
 *
 * Listet alle Einstellungen für Benutzer auf<br /><br />Benötigte Rechte:<br />**Unterbenutzer
 * verwalten** (api.user.manage)<br /><br /><a target="_blank"
 * href="/core/api#setting/listUserSettings">In Reseller-Interface öffnen</a>
 */
class SettingListUserSettings extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $userId  Benutzer-ID (optional)
     */
    public function __construct(
        protected ?string $userId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['userID' => $this->userId]);
    }

    public function resolveEndpoint(): string
    {
        return '/setting/listUserSettings';
    }
}
