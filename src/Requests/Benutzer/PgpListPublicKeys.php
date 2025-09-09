<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Benutzer;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_PGP_listPublicKeys
 *
 * Gibt eine Liste aller im Reseller vorhandenen öffentlichen (public) PGP-Schlüssel aus.<br /><br
 * />Benötigte Rechte:<br />**Eigene Resellerdaten verwalten** (api.reseller.manageSelf)<br /><br /><a
 * target="_blank" href="/core/api#PGP/listPublicKeys">In Reseller-Interface öffnen</a>
 */
class PgpListPublicKeys extends Request implements HasBody
{
    use HasJsonBody;

    protected Method $method = Method::POST;

    public function __construct() {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function resolveEndpoint(): string
    {
        return '/PGP/listPublicKeys';
    }
}
