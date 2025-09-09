<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Handles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_handle_create
 *
 * Legt einen neuen Handledatensatz an<br /><br />Benötigte Rechte:<br />**Handles anlegen**
 * (api.handle.create)<br /><br /><a target="_blank" href="/core/api#handle/create">In
 * Reseller-Interface öffnen</a>
 */
class HandleCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  Type  $type  Typ des Handles
     * @param  null|string  $company  Firmenname (optional)
     * @param  string  $firstname  Vorname
     * @param  string  $lastname  Nachname
     * @param  string  $street  Straße
     * @param  string  $city  Stadt
     * @param  string  $postcode  Postleitzahl
     * @param  string  $country  Ländercode ISO 3166-1
     * @param  string  $telephone  Telefonnummer
     * @param  null|string  $fax  Telefaxnummer (optional)
     * @param  string  $email  E-Mail-Adresse
     * @param  string  $tag  Tag
     * @param  array  $additionalParams  Handledaten (siehe Beispiel) [[handle/getDetailKeys](#post-/handle/getDetailKeys)]
     * @param  null|bool  $useExisting  Bestehendes Handle zurückgeben, falls Daten übereinstimmen, anstatt ein neues zu erstellen (optional)
     * @param  null|bool  $disclose  Daten im Whois ausgeben (optional)
     */
    public function __construct(
        protected ?int $resellerId,
        protected Type $type,
        protected ?string $company,
        protected string $firstname,
        protected string $lastname,
        protected string $street,
        protected string $city,
        protected string $postcode,
        protected string $country,
        protected string $telephone,
        protected ?string $fax,
        protected string $email,
        protected string $tag,
        protected array $additionalParams,
        protected ?bool $useExisting = null,
        protected ?bool $disclose = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'resellerID' => $this->resellerId,
            'type' => $this->type->value,
            'company' => $this->company,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'street' => $this->street,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'country' => $this->country,
            'telephone' => $this->telephone,
            'fax' => $this->fax,
            'email' => $this->email,
            'tag' => $this->tag,
            'additionalParams' => $this->additionalParams,
            'useExisting' => $this->useExisting,
            'disclose' => $this->disclose,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/handle/create';
    }
}
