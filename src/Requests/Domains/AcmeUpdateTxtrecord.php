<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Action;

/**
 * post_acme_updateTXTRecord
 *
 * Setzt einen TXT-Eintrag in der übergebenen Domain, um die dns-01 Challenge von Let's Encrypt zu
 * erfüllen<br /><br /><a target="_blank" href="/core/api#acme/updateTXTRecord">In Reseller-Interface
 * öffnen</a>
 */
class AcmeUpdateTxtrecord extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Voller Domainname inkl. _acme-challenge. , _pki-validation. oder _dnsauth.
     * @param  string  $token  API-Token für LE-API (von acme/generateToken)
     * @param  Action  $action  Aktion
     *                          * `set` TXT-Eintrag anlegen
     *                          * `delete` TXT-Eintrag löschen
     * @param  string  $value  Wert für den TXT-Eintrag
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     */
    public function __construct(
        protected string $domain,
        protected string $token,
        protected Action $action,
        protected string $value,
        protected ?int $ttl = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'token' => $this->token,
            'action' => $this->action->value,
            'value' => $this->value,
            'ttl' => $this->ttl,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/acme/updateTXTRecord';
    }
}
