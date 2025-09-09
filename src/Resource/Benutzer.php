<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Benutzer\PgpCreatePublicKey;
use TeamNiftyGmbH\ResellerInterface\Requests\Benutzer\PgpDeletePublicKey;
use TeamNiftyGmbH\ResellerInterface\Requests\Benutzer\PgpDetailsPublicKey;
use TeamNiftyGmbH\ResellerInterface\Requests\Benutzer\PgpListPublicKeys;
use TeamNiftyGmbH\ResellerInterface\Requests\Benutzer\PgpUpdatePublicKey;

class Benutzer extends BaseResource
{
    /**
     * @param  string  $email  E-Mail
     * @param  string  $publicKey  Öffentlicher PGP-Schlüssel (ASCII-Format)
     * @param  null|bool  $alwaysSign  Alle E-Mails signieren (optional)
     * @param  null|bool  $alwaysEncrypt  Alle E-Mails verschlüsseln (optional)
     * @param  null|bool  $onlyAcceptSigned  Nur signierte E-Mails akzeptieren (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pgpCreatePublicKey(
        string $email,
        string $publicKey,
        ?bool $alwaysSign = null,
        ?bool $alwaysEncrypt = null,
        ?bool $onlyAcceptSigned = null,
    ): Response {
        return $this->connector->send(new PgpCreatePublicKey($email, $publicKey, $alwaysSign, $alwaysEncrypt, $onlyAcceptSigned));
    }

    /**
     * @param  int  $id  ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pgpDeletePublicKey(int $id): Response
    {
        return $this->connector->send(new PgpDeletePublicKey($id));
    }

    /**
     * @param  int  $id  ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pgpDetailsPublicKey(int $id): Response
    {
        return $this->connector->send(new PgpDetailsPublicKey($id));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pgpListPublicKeys(): Response
    {
        return $this->connector->send(new PgpListPublicKeys());
    }

    /**
     * @param  int  $id  ID
     * @param  null|bool  $alwaysSign  Alle E-Mails signieren (optional)
     * @param  null|bool  $alwaysEncrypt  Alle E-Mails verschlüsseln (optional)
     * @param  null|bool  $onlyAcceptSigned  Nur signierte E-Mails akzeptieren (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function pgpUpdatePublicKey(
        int $id,
        ?bool $alwaysSign = null,
        ?bool $alwaysEncrypt = null,
        ?bool $onlyAcceptSigned = null,
    ): Response {
        return $this->connector->send(new PgpUpdatePublicKey($id, $alwaysSign, $alwaysEncrypt, $onlyAcceptSigned));
    }
}
