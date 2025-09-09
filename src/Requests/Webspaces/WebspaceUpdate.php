<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Webspace;

/**
 * post_webspace_update
 *
 * Aktualisiert die Informationen für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank" href="/core/api#webspace/update">In
 * Reseller-Interface öffnen</a>
 */
class WebspaceUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  string  $tag  Tag
     * @param  string  $comment  Kommentar
     * @param  null|array  $contactAddress  Ansprechpartner (optional)
     * @param  null|array  $settings  Einstellungen (optional) [[setting/listWebspaceSettings](#post-/setting/listWebspaceSettings)]
     */
    public function __construct(
        protected int $webspace,
        protected string $tag,
        protected string $comment,
        protected ?array $contactAddress = null,
        protected ?array $settings = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Webspace::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'tag' => $this->tag,
            'comment' => $this->comment,
            'contactAddress' => $this->contactAddress,
            'settings' => $this->settings,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/update';
    }
}
