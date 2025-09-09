<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Rights;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_rights_detailsRightsGroup
 *
 * Detailierte Informationen zu einer Rechte-Gruppe<br /><br /><a target="_blank"
 * href="/core/api#rights/detailsRightsGroup">In Reseller-Interface öffnen</a>
 */
class RightsDetailsRightsGroup extends Request implements HasBody
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
        return '/rights/detailsRightsGroup';
    }
}
