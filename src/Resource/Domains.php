<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Action;
use TeamNiftyGmbH\ResellerInterface\Enums\DeleteMode;
use TeamNiftyGmbH\ResellerInterface\Enums\ExpireDays;
use TeamNiftyGmbH\ResellerInterface\Enums\RedirectMode;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\State;
use TeamNiftyGmbH\ResellerInterface\Enums\TwoFaMethod;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\AcmeGenerateToken;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\AcmeUpdateTxtrecord;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainActivateDomainSafe;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainActivateExternal;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainAddTrustee;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainAnswerTransferRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainAuthDomainSafe;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainCancelTransfer;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainCheck;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainCreateExternal;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainDeactivateDomainSafe;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainDeleteAuthcode;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainDeletePushRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainDetailsPushRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainExecutePushRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainGenerateAuthcode;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainGetAuthDomainSafe;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainGetDnssec;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainGetDomainSafeDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainGetPushRequestPassword;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainHide;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainInitiatePushRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainList;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainListHostObjects;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainListIncomingPushRequests;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainListOutgoingPushRequests;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainListTransferRequests;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainMove;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainRejectPushRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainRenew;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainRequestResendIrtp;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainRequestResendIrtpContactVerification;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainRestore;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetDeleteMode;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetDnssec;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetDomainSafe;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetHandles;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetHostObjects;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetNameserver;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetRegistrarTag;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetStatus;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainSetTag;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainShowAuthcode;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainTrade;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainTransfer;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainUndelete;
use TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainUpdate;

class Domains extends BaseResource
{
    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function acmeGenerateToken(): Response
    {
        return $this->connector->send(new AcmeGenerateToken());
    }

    /**
     * @param  string  $domain  Voller Domainname inkl. _acme-challenge. , _pki-validation. oder _dnsauth.
     * @param  string  $token  API-Token für LE-API (von acme/generateToken)
     * @param  Action  $action  Aktion
     *                          * `set` TXT-Eintrag anlegen
     *                          * `delete` TXT-Eintrag löschen
     * @param  string  $value  Wert für den TXT-Eintrag
     * @param  null|int  $ttl  Gültigkeit der Resource (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function acmeUpdateTxtrecord(
        string $domain,
        string $token,
        Action $action,
        string $value,
        ?int $ttl = null,
    ): Response {
        return $this->connector->send(new AcmeUpdateTxtrecord($domain, $token, $action, $value, $ttl));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainActivateDomainSafe(int $domain, bool $revocationAccepted): Response
    {
        return $this->connector->send(new DomainActivateDomainSafe($domain, $revocationAccepted));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainActivateExternal(int $domain): Response
    {
        return $this->connector->send(new DomainActivateExternal($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $paymentAccepted  Hiermit bestätige ich die Kosten gemäß Preisliste.
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainAddTrustee(int $domain, bool $paymentAccepted): Response
    {
        return $this->connector->send(new DomainAddTrustee($domain, $paymentAccepted));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  int  $transferRequestId  Transfer-Anfrage-ID
     * @param  State  $state  Statuscode
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainAnswerTransferRequest(int $domain, int $transferRequestId, State $state): Response
    {
        return $this->connector->send(new DomainAnswerTransferRequest($domain, $transferRequestId, $state));
    }

    /**
     * @param  TwoFaMethod  $twoFaMethod  TwoFA-Methode
     * @param  bool  $temp  Temporär
     * @param  array  $value  Werte für die TwoFA-Methode
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainAuthDomainSafe(TwoFaMethod $twoFaMethod, bool $temp, array $value): Response
    {
        return $this->connector->send(new DomainAuthDomainSafe($twoFaMethod, $temp, $value));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainCancelTransfer(int $domain): Response
    {
        return $this->connector->send(new DomainCancelTransfer($domain));
    }

    /**
     * @param  array  $domain  Liste an Domains
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainCheck(array $domain): Response
    {
        return $this->connector->send(new DomainCheck($domain));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  array  $handles  Handles [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|RedirectMode  $redirectMode  WEB-Weiterleitungsart (optional)
     * @param  null|array  $nameserver  Externe Nameserver (nur für redirectMode=external) (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|array  $ipRedirect  Ziel IP-Adresse (nur für redirectMode=ipredirect) (optional)
     * @param  null|array  $frameRedirect  Frame-Konfiguration (nur für redirectMode=frame) (optional)
     * @param  null|array  $rrTemplate  RR-Template-Konfiguration (nur für redirectMode=rrtemplate) (optional)
     * @param  null|array  $webspace  Webspace-Konfiguration (nur für redirectMode=webspace) (optional)
     * @param  null|array  $records  DNS-Records (nur für redirectMode=individual) (optional)
     * @param  null|array  $dnssec  öffentliche DNSSEC Schlüssel (optional) [[domain/setDnssec](#post-/domain/setDnssec)]
     * @param  null|bool  $autoDnssec  (optional)
     * @param  null|array  $tldExotic  Zusatzdaten für spezielle TLDs, z.B. Steuernummern (optional) [[domain/setTldExotic](#post-/domain/setTldExotic)]
     * @param  null|int  $vnsId  ID eines virtuellen Nameservers (optional)
     * @param  null|int  $ensId  ID eines externen Nameserver-Sets (optional)
     * @param  null|string  $tag  Tag (optional)
     * @param  null|bool  $trustee  Trustee hinzufügen (optional)
     * @param  null|bool  $whoisPrivacy  Whois-Schutz hinzufügen (optional)
     * @param  null|bool  $premiumOk  (optional)
     * @param  null|string  $premiumClassOk  (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainCreate(
        string $domain,
        array $handles,
        ?RedirectMode $redirectMode = null,
        ?array $nameserver = null,
        ?array $ipRedirect = null,
        ?array $frameRedirect = null,
        ?array $rrTemplate = null,
        ?array $webspace = null,
        ?array $records = null,
        ?array $dnssec = null,
        ?bool $autoDnssec = null,
        ?array $tldExotic = null,
        ?int $vnsId = null,
        ?int $ensId = null,
        ?string $tag = null,
        ?bool $trustee = null,
        ?bool $whoisPrivacy = null,
        ?bool $premiumOk = null,
        ?string $premiumClassOk = null,
        ?bool $fullyAsync = null,
        ?int $runtime = null,
    ): Response {
        return $this->connector->send(new DomainCreate($domain, $handles, $redirectMode, $nameserver, $ipRedirect, $frameRedirect, $rrTemplate, $webspace, $records, $dnssec, $autoDnssec, $tldExotic, $vnsId, $ensId, $tag, $trustee, $whoisPrivacy, $premiumOk, $premiumClassOk, $fullyAsync, $runtime));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|RedirectMode  $redirectMode  Weiterleitungsmodus (optional)
     * @param  null|array  $nameserver  Externe Nameserver (nur für redirectMode=external) (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|array  $ipRedirect  Ziel IP-Adresse (nur für redirectMode=ipredirect) (optional)
     * @param  null|array  $frameRedirect  Frame-Konfiguration (nur für redirectMode=frame) (optional)
     * @param  null|array  $rrTemplate  RR-Template-Konfiguration (nur für redirectMode=rrtemplate) (optional)
     * @param  null|array  $webspace  Webspace-Konfiguration (nur für redirectMode=webspace) (optional)
     * @param  null|array  $records  DNS-Records (nur für redirectMode=individual) (optional)
     * @param  null|array  $tldExotic  Zusatzdaten für spezielle TLDs, z.B. Steuernummern (optional) [[domain/setTldExotic](#post-/domain/setTldExotic)]
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainCreateExternal(
        string $domain,
        ?RedirectMode $redirectMode,
        ?array $nameserver,
        ?array $ipRedirect,
        ?array $frameRedirect,
        ?array $rrTemplate,
        ?array $webspace,
        ?array $records,
        ?array $tldExotic,
        bool $revocationAccepted,
    ): Response {
        return $this->connector->send(new DomainCreateExternal($domain, $redirectMode, $nameserver, $ipRedirect, $frameRedirect, $rrTemplate, $webspace, $records, $tldExotic, $revocationAccepted));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $instantCancel  Kündigung zu Sofort
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainDeactivateDomainSafe(int $domain, bool $instantCancel): Response
    {
        return $this->connector->send(new DomainDeactivateDomainSafe($domain, $instantCancel));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|string  $date  Datum (optional)
     * @param  null|bool  $transit  Transit ausführen (optional)
     * @param  null|bool  $disconnect  Diskonnektieren (optional)
     * @param  null|string  $sms  TwoFA SMS-Code (optional)
     * @param  null|string  $totp  TwoFA TOTP-Code (optional)
     * @param  null|string  $reason  Grund der Kündigung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainDelete(
        int $domain,
        ?string $date = null,
        ?bool $transit = null,
        ?bool $disconnect = null,
        ?string $sms = null,
        ?string $totp = null,
        ?string $reason = null,
    ): Response {
        return $this->connector->send(new DomainDelete($domain, $date, $transit, $disconnect, $sms, $totp, $reason));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainDeleteAuthcode(int $domain): Response
    {
        return $this->connector->send(new DomainDeleteAuthcode($domain));
    }

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainDeletePushRequest(int $pushRequestId): Response
    {
        return $this->connector->send(new DomainDeletePushRequest($pushRequestId));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainDetails(int $domain): Response
    {
        return $this->connector->send(new DomainDetails($domain));
    }

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainDetailsPushRequest(int $pushRequestId): Response
    {
        return $this->connector->send(new DomainDetailsPushRequest($pushRequestId));
    }

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     * @param  string  $password  Passwort des Domain-Push-Auftrags
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainExecutePushRequest(int $pushRequestId, string $password, bool $revocationAccepted): Response
    {
        return $this->connector->send(new DomainExecutePushRequest($pushRequestId, $password, $revocationAccepted));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|ExpireDays  $expireDays  Authcode-Gültigkeit in Tagen (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainGenerateAuthcode(
        int $domain,
        ?ExpireDays $expireDays = null,
        ?bool $waitForResponse = null,
    ): Response {
        return $this->connector->send(new DomainGenerateAuthcode($domain, $expireDays, $waitForResponse));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainGetAuthDomainSafe(): Response
    {
        return $this->connector->send(new DomainGetAuthDomainSafe());
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainGetDnssec(int $domain): Response
    {
        return $this->connector->send(new DomainGetDnssec($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainGetDomainSafeDetails(int $domain): Response
    {
        return $this->connector->send(new DomainGetDomainSafeDetails($domain));
    }

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainGetPushRequestPassword(int $pushRequestId): Response
    {
        return $this->connector->send(new DomainGetPushRequestPassword($pushRequestId));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainHide(int $domain): Response
    {
        return $this->connector->send(new DomainHide($domain));
    }

    /**
     * @param  array  $domain  Domainname (sld.tld)
     * @param  int  $targetResellerId  Reseller-ID des Zielaccounts
     * @param  null|bool  $cloneSettings  Einstellungen mit kopieren (optional)
     * @param  null|bool  $cloneHandles  Handles kopieren (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainInitiatePushRequest(
        array $domain,
        int $targetResellerId,
        ?bool $cloneSettings = null,
        ?bool $cloneHandles = null,
    ): Response {
        return $this->connector->send(new DomainInitiatePushRequest($domain, $targetResellerId, $cloneSettings, $cloneHandles));
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|array  $stateFilter  Status-Filter (optional)
     * @param  null|bool  $csv  Ergebnis als CSV-Datei herunterladen (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|array  $include  Weitere Informationen abfragen (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainList(
        ?ResellerID $resellerId = null,
        ?array $stateFilter = null,
        ?bool $csv = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?array $include = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new DomainList($resellerId, $stateFilter, $csv, $search, $filter, $sort, $include, $offset, $limit));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainListHostObjects(int $domain): Response
    {
        return $this->connector->send(new DomainListHostObjects($domain));
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainListIncomingPushRequests(): Response
    {
        return $this->connector->send(new DomainListIncomingPushRequests());
    }

    /**
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainListOutgoingPushRequests(): Response
    {
        return $this->connector->send(new DomainListOutgoingPushRequests());
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainListTransferRequests(
        ?ResellerID $resellerId = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new DomainListTransferRequests($resellerId, $search, $filter, $sort, $offset, $limit));
    }

    /**
     * @param  int|string  $domain  Domain-ID oder Domainname
     * @param  int  $targetResellerId  Reseller-ID des Zielaccounts
     * @param  null|bool  $cloneHandles  Handles kopieren (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainMove(int|string $domain, int $targetResellerId, ?bool $cloneHandles = null): Response
    {
        return $this->connector->send(new DomainMove($domain, $targetResellerId, $cloneHandles));
    }

    /**
     * @param  int  $pushRequestId  Domain-Push-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainRejectPushRequest(int $pushRequestId): Response
    {
        return $this->connector->send(new DomainRejectPushRequest($pushRequestId));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainRenew(int $domain, ?int $runtime = null, ?bool $fullyAsync = null): Response
    {
        return $this->connector->send(new DomainRenew($domain, $runtime, $fullyAsync));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainRequestResendIrtp(int $domain): Response
    {
        return $this->connector->send(new DomainRequestResendIrtp($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainRequestResendIrtpContactVerification(int $domain): Response
    {
        return $this->connector->send(new DomainRequestResendIrtpContactVerification($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainRestore(int $domain, ?int $runtime = null, ?bool $fullyAsync = null): Response
    {
        return $this->connector->send(new DomainRestore($domain, $runtime, $fullyAsync));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  DeleteMode  $deleteMode  Löschmodus
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetDeleteMode(int $domain, DeleteMode $deleteMode): Response
    {
        return $this->connector->send(new DomainSetDeleteMode($domain, $deleteMode));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  array  $dnssec  Die DNSSEC-Einträge
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetDnssec(int $domain, array $dnssec): Response
    {
        return $this->connector->send(new DomainSetDnssec($domain, $dnssec));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  bool  $lockUpdate  Domainupdates verbieten
     * @param  bool  $lockTransfer  Domaintransfers verbieten
     * @param  bool  $lockCancellation  Domainkündigung verbieten
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetDomainSafe(
        int $domain,
        bool $lockUpdate,
        bool $lockTransfer,
        bool $lockCancellation,
    ): Response {
        return $this->connector->send(new DomainSetDomainSafe($domain, $lockUpdate, $lockTransfer, $lockCancellation));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetHandles(int $domain, array $handles): Response
    {
        return $this->connector->send(new DomainSetHandles($domain, $handles));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  array  $hostObjects  Host-Objekte
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetHostObjects(int $domain, array $hostObjects): Response
    {
        return $this->connector->send(new DomainSetHostObjects($domain, $hostObjects));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  array  $nameserver  Nameserver
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetNameserver(int $domain, array $nameserver): Response
    {
        return $this->connector->send(new DomainSetNameserver($domain, $nameserver));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $registrarTag  Registrar-TAG
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetRegistrarTag(int $domain, string $registrarTag): Response
    {
        return $this->connector->send(new DomainSetRegistrarTag($domain, $registrarTag));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|bool  $transferLock  Transfersperre de-/aktivieren (optional)
     * @param  null|bool  $updateLock  Updatesperre de-/aktivieren (optional)
     * @param  null|bool  $deleteLock  Löschsperre de-/aktivieren (optional)
     * @param  null|bool  $clientHold  Auflösungssperre de-/aktivieren (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetStatus(
        int $domain,
        ?bool $transferLock = null,
        ?bool $updateLock = null,
        ?bool $deleteLock = null,
        ?bool $clientHold = null,
    ): Response {
        return $this->connector->send(new DomainSetStatus($domain, $transferLock, $updateLock, $deleteLock, $clientHold));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|string  $tag  Tag (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainSetTag(int $domain, ?string $tag = null): Response
    {
        return $this->connector->send(new DomainSetTag($domain, $tag));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainShowAuthcode(int $domain): Response
    {
        return $this->connector->send(new DomainShowAuthcode($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|string  $owner  Owner-Handle (optional) [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainTrade(int $domain, ?string $owner = null, ?bool $fullyAsync = null): Response
    {
        return $this->connector->send(new DomainTrade($domain, $owner, $fullyAsync));
    }

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  array  $handles  Handles [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|RedirectMode  $redirectMode  WEB-Weiterleitungsart (optional)
     * @param  null|array  $nameserver  Externe Nameserver (nur für redirectMode=external) (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|array  $ipRedirect  Ziel IP-Adresse (nur für redirectMode=ipredirect) (optional)
     * @param  null|array  $frameRedirect  Frame-Konfiguration (nur für redirectMode=frame) (optional)
     * @param  null|array  $rrTemplate  RR-Template-Konfiguration (nur für redirectMode=rrtemplate) (optional)
     * @param  null|array  $webspace  Webspace-Konfiguration (nur für redirectMode=webspace) (optional)
     * @param  null|array  $records  DNS-Records (nur für redirectMode=individual) (optional)
     * @param  null|array  $dnssec  öffentliche DNSSEC Schlüssel (optional) [[domain/setDnssec](#post-/domain/setDnssec)]
     * @param  null|bool  $autoDnssec  (optional)
     * @param  null|array  $tldExotic  Zusatzdaten für spezielle TLDs, z.B. Steuernummern (optional) [[domain/setTldExotic](#post-/domain/setTldExotic)]
     * @param  null|string  $authcode  Authcode (optional)
     * @param  null|string  $transferDate  gewünschtes Umzugsdatum (optional)
     * @param  null|int  $vnsId  ID eines virtuellen Nameservers (optional)
     * @param  null|int  $ensId  ID eines externen Nameserver-Sets (optional)
     * @param  null|string  $tag  Tag (optional)
     * @param  null|bool  $trustee  Trustee hinzufügen (optional)
     * @param  null|bool  $whoisPrivacy  Whois-Schutz hinzufügen (optional)
     * @param  null|bool  $premiumOk  (optional)
     * @param  null|string  $premiumClassOk  (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainTransfer(
        string $domain,
        array $handles,
        ?RedirectMode $redirectMode = null,
        ?array $nameserver = null,
        ?array $ipRedirect = null,
        ?array $frameRedirect = null,
        ?array $rrTemplate = null,
        ?array $webspace = null,
        ?array $records = null,
        ?array $dnssec = null,
        ?bool $autoDnssec = null,
        ?array $tldExotic = null,
        ?string $authcode = null,
        ?string $transferDate = null,
        ?int $vnsId = null,
        ?int $ensId = null,
        ?string $tag = null,
        ?bool $trustee = null,
        ?bool $whoisPrivacy = null,
        ?bool $premiumOk = null,
        ?string $premiumClassOk = null,
        ?bool $fullyAsync = null,
    ): Response {
        return $this->connector->send(new DomainTransfer($domain, $handles, $redirectMode, $nameserver, $ipRedirect, $frameRedirect, $rrTemplate, $webspace, $records, $dnssec, $autoDnssec, $tldExotic, $authcode, $transferDate, $vnsId, $ensId, $tag, $trustee, $whoisPrivacy, $premiumOk, $premiumClassOk, $fullyAsync));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainUndelete(int $domain): Response
    {
        return $this->connector->send(new DomainUndelete($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|array  $handles  Handles (optional) [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|bool  $tradeOk  erlaubt einen (evtl. kostenpflichtigen) Inhaberwechsel (optional)
     * @param  null|array  $nameserver  Nameserver (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|int  $ensId  ID eines externen Nameserver-Sets (optional)
     * @param  null|array  $dnssec  öffentliche DNSSEC Schlüssel (optional) [[domain/setDnssec](#post-/domain/setDnssec)]
     * @param  null|bool  $trustee  Trustee hinzufügen (true) oder vorhandenen Trustee entfernen (false) (optional)
     * @param  null|bool  $whoisPrivacy  Whois-Schutz hinzufügen (true) oder vorhandenen Whois-Schutz entfernen (false) (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainUpdate(
        int $domain,
        ?array $handles = null,
        ?bool $tradeOk = null,
        ?array $nameserver = null,
        ?int $ensId = null,
        ?array $dnssec = null,
        ?bool $trustee = null,
        ?bool $whoisPrivacy = null,
        ?bool $fullyAsync = null,
    ): Response {
        return $this->connector->send(new DomainUpdate($domain, $handles, $tradeOk, $nameserver, $ensId, $dnssec, $trustee, $whoisPrivacy, $fullyAsync));
    }
}
