<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Gdpr;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_gdpr_requestExport
 *
 * Fordert ein Datenschutzexport an<br /><br />Benötigte Rechte:<br />**Eigene Resellerdaten
 * verwalten** (api.reseller.manageSelf)<br /><br /><a target="_blank"
 * href="/core/api#gdpr/requestExport">In Reseller-Interface öffnen</a>
 */
class GdprRequestExport extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $resellerId  Reseller-ID (optional)
     */
    public function __construct(
        protected ?string $resellerId = null,
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
        return '/gdpr/requestExport';
    }
}
