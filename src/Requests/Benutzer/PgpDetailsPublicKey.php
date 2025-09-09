<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Benutzer;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_PGP_detailsPublicKey
 *
 * Gibt Detailinformationen zu einem PGP-Schlüssel aus.<br /><br />Benötigte Rechte:<br />**Eigene
 * Resellerdaten verwalten** (api.reseller.manageSelf)<br /><br /><a target="_blank"
 * href="/core/api#PGP/detailsPublicKey">In Reseller-Interface öffnen</a>
 */
class PgpDetailsPublicKey extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $id  ID
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
        return '/PGP/detailsPublicKey';
    }
}
