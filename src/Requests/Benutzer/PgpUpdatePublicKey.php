<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Benutzer;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_PGP_updatePublicKey
 *
 * Ändert Parameter wie alwaysSign, alwaysEncrypt, etc. bei einem öffentlichen PGP-Schlüssel. Zum
 * Austausch des Keys oder der E-Mail-Adresse muss der Key gelöscht und neuangelegt werden.<br /><br
 * />Benötigte Rechte:<br />**Eigene Resellerdaten verwalten** (api.reseller.manageSelf)<br /><br /><a
 * target="_blank" href="/core/api#PGP/updatePublicKey">In Reseller-Interface öffnen</a>
 */
class PgpUpdatePublicKey extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $id  ID
     * @param  null|bool  $alwaysSign  Alle E-Mails signieren (optional)
     * @param  null|bool  $alwaysEncrypt  Alle E-Mails verschlüsseln (optional)
     * @param  null|bool  $onlyAcceptSigned  Nur signierte E-Mails akzeptieren (optional)
     */
    public function __construct(
        protected int $id,
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
            'id' => $this->id,
            'alwaysSign' => $this->alwaysSign,
            'alwaysEncrypt' => $this->alwaysEncrypt,
            'onlyAcceptSigned' => $this->onlyAcceptSigned,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/PGP/updatePublicKey';
    }
}
