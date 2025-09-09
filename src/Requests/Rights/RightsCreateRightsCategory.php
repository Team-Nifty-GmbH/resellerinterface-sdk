<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Rights;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_rights_createRightsCategory
 *
 * Legt eine neue Rechte-Kategorie an
 * • Eine Übersicht der zur Verfügung stehenden Rechte-Gruppen
 * kannst Du mit rightsGroup/list abrufen.<br /><br />Benötigte Rechte:<br />**Rechte verwalten**
 * (api.rights.manage)<br /><br /><a target="_blank" href="/core/api#rights/createRightsCategory">In
 * Reseller-Interface öffnen</a>
 */
class RightsCreateRightsCategory extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $name  Gruppen-Name
     * @param  array  $rightsGroups  Rechte-Gruppen-IDs
     */
    public function __construct(
        protected string $name,
        protected array $rightsGroups,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['name' => $this->name, 'rightsGroups' => $this->rightsGroups]);
    }

    public function resolveEndpoint(): string
    {
        return '/rights/createRightsCategory';
    }
}
