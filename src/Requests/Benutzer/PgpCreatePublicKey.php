<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Benutzer;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_PGP_createPublicKey
 *
 * Legt einen neuen öffentlichen (public) PGP-Schlüssel an.<br /><br />Benötigte Rechte:<br
 * />**Eigene Resellerdaten verwalten** (api.reseller.manageSelf)<br /><br /><a target="_blank"
 * href="/core/api#PGP/createPublicKey">In Reseller-Interface öffnen</a>
 */
class PgpCreatePublicKey extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $email  E-Mail
     * @param  string  $publicKey  Öffentlicher PGP-Schlüssel (ASCII-Format)
     * @param  null|bool  $alwaysSign  Alle E-Mails signieren (optional)
     * @param  null|bool  $alwaysEncrypt  Alle E-Mails verschlüsseln (optional)
     * @param  null|bool  $onlyAcceptSigned  Nur signierte E-Mails akzeptieren (optional)
     */
    public function __construct(
        protected string $email,
        protected string $publicKey,
        protected ?bool $alwaysSign = null,
        protected ?bool $alwaysEncrypt = null,
        protected ?bool $onlyAcceptSigned = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'email' => $this->email,
            'publicKey' => $this->publicKey,
            'alwaysSign' => $this->alwaysSign,
            'alwaysEncrypt' => $this->alwaysEncrypt,
            'onlyAcceptSigned' => $this->onlyAcceptSigned,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/PGP/createPublicKey';
    }
}
