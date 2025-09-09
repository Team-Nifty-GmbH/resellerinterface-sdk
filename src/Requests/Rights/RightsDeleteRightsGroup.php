<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Rights;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_rights_deleteRightsGroup
 *
 * Löscht eine Rechte-Gruppe<br /><br />Benötigte Rechte:<br />**Rechte verwalten**
 * (api.rights.manage)<br /><br /><a target="_blank" href="/core/api#rights/deleteRightsGroup">In
 * Reseller-Interface öffnen</a>
 */
class RightsDeleteRightsGroup extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $id  Gruppen-ID
     */
    public function __construct(
        protected int $id,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['id' => $this->id]);
    }

    public function resolveEndpoint(): string
    {
        return '/rights/deleteRightsGroup';
    }
}
