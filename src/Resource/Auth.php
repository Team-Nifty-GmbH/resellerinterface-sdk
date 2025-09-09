<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\Section;
use TeamNiftyGmbH\ResellerInterface\Enums\TwoFaMethod;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthActivate;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthGenerateSecret;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthList;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthListApiIpRestrictions;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthSendSmscodeForLogin;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthSetApiIpRestrictions;
use TeamNiftyGmbH\ResellerInterface\Requests\Auth\AuthUpdate;

class Auth extends BaseResource
{
    /**
     * @param  int  $userId  Benutzer-ID
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     * @param  Section  $section  Welche Bereiche sollen durch TwoFA gesichert werden
     * @param  TwoFaMethod  $value  Werte für die TwoFA-Methode
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authActivate(int $userId, TwoFaMethod $twoFaMethod, Section $section, TwoFaMethod $value): Response
    {
        return $this->connector->send(new AuthActivate($userId, $twoFaMethod, $section, $value));
    }

    /**
     * @param  int  $userId  Benutzer-ID
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authDelete(int $userId, TwoFaMethod $twoFaMethod): Response
    {
        return $this->connector->send(new AuthDelete($userId, $twoFaMethod));
    }

    /**
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authDetails(?int $userId, TwoFaMethod $twoFaMethod): Response
    {
        return $this->connector->send(new AuthDetails($userId, $twoFaMethod));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authGenerateSecret(): Response
    {
        return $this->connector->send(new AuthGenerateSecret());
    }

    /**
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  Section  $section  TwoFA-Bereich
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authList(?int $userId, Section $section, TwoFaMethod $twoFaMethod): Response
    {
        return $this->connector->send(new AuthList($userId, $section, $twoFaMethod));
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authListApiIpRestrictions(?ResellerID $resellerId = null): Response
    {
        return $this->connector->send(new AuthListApiIpRestrictions($resellerId));
    }

    /**
     * @param  string  $username  Benutzername
     * @param  string  $password  Passwort
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authSendSmscodeForLogin(string $username, string $password): Response
    {
        return $this->connector->send(new AuthSendSmscodeForLogin($username, $password));
    }

    /**
     * @param  null|array  $ip  IP-Adresse (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authSetApiIpRestrictions(?array $ip = null): Response
    {
        return $this->connector->send(new AuthSetApiIpRestrictions($ip));
    }

    /**
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     * @param  Section  $section  Welche Bereiche sollen durch TwoFA gesichert werden
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function authUpdate(?int $userId, TwoFaMethod $twoFaMethod, Section $section): Response
    {
        return $this->connector->send(new AuthUpdate($userId, $twoFaMethod, $section));
    }
}
