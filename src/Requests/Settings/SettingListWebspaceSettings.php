<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Settings;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_setting_listWebspaceSettings
 *
 * Listet alle Webspace-Einstellungen auf<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#setting/listWebspaceSettings">In Reseller-Interface öffnen</a>
 */
class SettingListWebspaceSettings extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     */
    public function __construct(
        protected int $webspace,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace]);
    }

    public function resolveEndpoint(): string
    {
        return '/setting/listWebspaceSettings';
    }
}
