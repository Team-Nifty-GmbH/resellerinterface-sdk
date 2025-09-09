<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\RenewalMode;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsCancel;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsCreate;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsDetails;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsDownload;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsHide;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsList;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsRenew;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsSetPaymentRuntime;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsSetRenewalMode;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsUncancel;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsUpdate;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsUpdateDcv;
use TeamNiftyGmbH\ResellerInterface\Requests\Ssl\TlsUpgrade;

class Ssl extends BaseResource
{
    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|string  $reason  Grund der Kündigung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsCancel(string $tls, ?string $reason = null): Response
    {
        return $this->connector->send(new TlsCancel($tls, $reason));
    }

    /**
     * @param  string  $product  TLS-Produkt
     * @param  string  $domain  Domain, für die das Zertifikat ausgestellt werden soll
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|bool  $wildcard  Handelt es sich um ein Wildcard-Zertifikat? (optional)
     * @param  null|string  $customerCsr  Eigenes CSR (optional)
     * @param  null|string  $customerKey  Private Schlüssel des eigenen CSRs (optional)
     * @param  null|string  $csrCountry  Land (optional)
     * @param  null|string  $csrState  Bundesstaat (optional)
     * @param  null|string  $csrCity  Stadt (optional)
     * @param  null|string  $csrName  Name (optional)
     * @param  null|string  $company  Firmenname (optional)
     * @param  null|string  $department  Abteilung (optional)
     * @param  null|string  $street  Straße (optional)
     * @param  null|string  $postcode  Postleitzahl (optional)
     * @param  null|string  $city  Stadt (optional)
     * @param  null|string  $firstname  Vorname (optional)
     * @param  null|string  $lastname  Nachname (optional)
     * @param  null|string  $phone  Telefonnummer (optional)
     * @param  null|string  $email  E-Mail (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsCreate(
        string $product,
        string $domain,
        ?int $paymentRuntime = null,
        ?bool $wildcard = null,
        ?string $customerCsr = null,
        ?string $customerKey = null,
        ?string $csrCountry = null,
        ?string $csrState = null,
        ?string $csrCity = null,
        ?string $csrName = null,
        ?string $company = null,
        ?string $department = null,
        ?string $street = null,
        ?string $postcode = null,
        ?string $city = null,
        ?string $firstname = null,
        ?string $lastname = null,
        ?string $phone = null,
        ?string $email = null,
        ?bool $fullyAsync = null,
    ): Response {
        return $this->connector->send(new TlsCreate($product, $domain, $paymentRuntime, $wildcard, $customerCsr, $customerKey, $csrCountry, $csrState, $csrCity, $csrName, $company, $department, $street, $postcode, $city, $firstname, $lastname, $phone, $email, $fullyAsync));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsDetails(string $tls): Response
    {
        return $this->connector->send(new TlsDetails($tls));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsDownload(string $tls): Response
    {
        return $this->connector->send(new TlsDownload($tls));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsHide(string $tls): Response
    {
        return $this->connector->send(new TlsHide($tls));
    }

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
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
    public function tlsList(
        ?ResellerID $resellerId = null,
        ?array $search = null,
        ?array $filter = null,
        ?array $sort = null,
        ?array $include = null,
        ?int $offset = null,
        ?int $limit = null,
    ): Response {
        return $this->connector->send(new TlsList($resellerId, $search, $filter, $sort, $include, $offset, $limit));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsRenew(string $tls, ?int $paymentRuntime = null, ?bool $fullyAsync = null): Response
    {
        return $this->connector->send(new TlsRenew($tls, $paymentRuntime, $fullyAsync));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|bool  $forNextContractPeriod  Zahlungsintervall erst bei der nächsten Vertragsverlängerung anpassen anstatt zum nächstmöglichen Zeitpunkt (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsSetPaymentRuntime(
        string $tls,
        ?int $paymentRuntime = null,
        ?bool $forNextContractPeriod = null,
    ): Response {
        return $this->connector->send(new TlsSetPaymentRuntime($tls, $paymentRuntime, $forNextContractPeriod));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  RenewalMode  $renewalMode  Verlängerungsmodus
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsSetRenewalMode(string $tls, RenewalMode $renewalMode): Response
    {
        return $this->connector->send(new TlsSetRenewalMode($tls, $renewalMode));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsUncancel(string $tls): Response
    {
        return $this->connector->send(new TlsUncancel($tls));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  null|string  $tag  Tag (optional)
     * @param  null|string  $comment  Kommentar (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsUpdate(string $tls, ?string $tag = null, ?string $comment = null): Response
    {
        return $this->connector->send(new TlsUpdate($tls, $tag, $comment));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  Type  $type  DCV-Modus
     * @param  null|string  $email  Bestätigungs-E-Mail-Adresse (optional)
     * @param  null|bool  $waitForResponse  Wartet max. 5 Sekunden auf eine Live-Antwort (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsUpdateDcv(string $tls, Type $type, ?string $email = null, ?bool $waitForResponse = null): Response
    {
        return $this->connector->send(new TlsUpdateDcv($tls, $type, $email, $waitForResponse));
    }

    /**
     * @param  string  $tls  TLS-ID oder Alias
     * @param  string  $product  TLS-Produkt
     * @param  null|string  $reason  Grund der Aufwertung (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function tlsUpgrade(string $tls, string $product, ?string $reason = null): Response
    {
        return $this->connector->send(new TlsUpgrade($tls, $product, $reason));
    }
}
