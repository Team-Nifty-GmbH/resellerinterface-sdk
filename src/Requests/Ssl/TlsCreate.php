<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ssl;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Tls;

/**
 * post_tls_create
 *
 * Erstellt ein neues SSL-Zertifikat<br /><br />Benötigte Rechte:<br />**SSL-Zertifikate bestellen**
 * (api.tls.order)<br /><br /><a target="_blank" href="/core/api#tls/create">In Reseller-Interface
 * öffnen</a>
 */
class TlsCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

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
     */
    public function __construct(
        protected string $product,
        protected string $domain,
        protected ?int $paymentRuntime = null,
        protected ?bool $wildcard = null,
        protected ?string $customerCsr = null,
        protected ?string $customerKey = null,
        protected ?string $csrCountry = null,
        protected ?string $csrState = null,
        protected ?string $csrCity = null,
        protected ?string $csrName = null,
        protected ?string $company = null,
        protected ?string $department = null,
        protected ?string $street = null,
        protected ?string $postcode = null,
        protected ?string $city = null,
        protected ?string $firstname = null,
        protected ?string $lastname = null,
        protected ?string $phone = null,
        protected ?string $email = null,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Tls::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'product' => $this->product,
            'domain' => $this->domain,
            'paymentRuntime' => $this->paymentRuntime,
            'wildcard' => $this->wildcard,
            'customerCSR' => $this->customerCsr,
            'customerKey' => $this->customerKey,
            'csrCountry' => $this->csrCountry,
            'csrState' => $this->csrState,
            'csrCity' => $this->csrCity,
            'csrName' => $this->csrName,
            'company' => $this->company,
            'department' => $this->department,
            'street' => $this->street,
            'postcode' => $this->postcode,
            'city' => $this->city,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phone' => $this->phone,
            'email' => $this->email,
            'fullyAsync' => $this->fullyAsync,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/tls/create';
    }
}
