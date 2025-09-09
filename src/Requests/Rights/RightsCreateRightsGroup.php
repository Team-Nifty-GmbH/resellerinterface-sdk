<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Rights;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_rights_createRightsGroup
 *
 * Legt eine neue Rechte-Gruppe an
 * • Es werden nur Rechte gesetzt die der aktuelle Benutzer auch
 * besitzt.
 * • Eine Übersicht der zur Verfügung stehenden Rechte kannst Du mit user/details
 * abrufen.
 * • Als Wert kannst Du 0=false oder 1=true angeben. Alle Rechte einer Gruppe müssen den
 * selben Wert haben wie die Gruppe selbst. Innerhalb einer Gruppe müssen alle Werte entweder 1 oder 0
 * sein.<br /><br />Benötigte Rechte:<br />**Rechte verwalten** (api.rights.manage)<br /><br /><a
 * target="_blank" href="/core/api#rights/createRightsGroup">In Reseller-Interface öffnen</a>
 */
class RightsCreateRightsGroup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $name  Gruppen-Name
     * @param  bool  $rightsState  Wert der Rechte-Gruppe
     * @param  null|array  $rights  Rechte des Benutzers (optional) [[rights/list](#post-/rights/list)]
     */
    public function __construct(
        protected string $name,
        protected bool $rightsState,
        protected ?array $rights = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['name' => $this->name, 'rightsState' => $this->rightsState, 'rights' => $this->rights]);
    }

    public function resolveEndpoint(): string
    {
        return '/rights/createRightsGroup';
    }
}
