<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Rights;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_rights_listRightsCategories
 *
 * Listet alle Rechte-Kategorien auf<br>
 * • Es werden maximal 1000 Einträge zurückgegeben<br /><br
 * /><a target="_blank" href="/core/api#rights/listRightsCategories">In Reseller-Interface öffnen</a>
 */
class RightsListRightsCategories extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     */
    public function __construct(
        protected ?int $resellerId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId]);
    }

    public function resolveEndpoint(): string
    {
        return '/rights/listRightsCategories';
    }
}
