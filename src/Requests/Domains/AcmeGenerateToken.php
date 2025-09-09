<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasJsonBody;

/**
 * post_acme_generateToken
 *
 * Legt einen neuen Zugangstoken für die Let's Encrypt-API an. Dieses Token berechtigt zum Setzen von
 * TXT-Einträgen in allen Domains des Resellers. Alle vorherigen Token werden gelöscht.<br /><br
 * />Benötigte Rechte:<br />**Zonenrecords (RR) verwalten** (api.dns.manageRecords)<br /><br /><a
 * target="_blank" href="/core/api#acme/generateToken">In Reseller-Interface öffnen</a>
 */
class AcmeGenerateToken extends Request implements HasBody
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
        return '/acme/generateToken';
    }
}
