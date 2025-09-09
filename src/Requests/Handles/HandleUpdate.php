<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Handles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_handle_update
 *
 * Aktualisiert die Daten in einem Handledatensatz<br /><br />Benötigte Rechte:<br />**Handles
 * verwalten** (api.handle.manage)<br /><br /><a target="_blank" href="/core/api#handle/update">In
 * Reseller-Interface öffnen</a>
 */
class HandleUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $alias  Alias
     * @param  string  $street  Straße
     * @param  string  $city  Stadt
     * @param  string  $postcode  Postleitzahl
     * @param  string  $telephone  Telefonnummer
     * @param  string  $fax  Telefaxnummer
     * @param  string  $email  E-Mail-Adresse
     * @param  string  $tag  Tag
     * @param  array  $additionalParams  Handledaten (siehe Beispiel) [[handle/getDetailKeys](#post-/handle/getDetailKeys)]
     * @param  null|bool  $disclose  Daten im Whois ausgeben (optional)
     */
    public function __construct(
        protected string $alias,
        protected string $street,
        protected string $city,
        protected string $postcode,
        protected string $telephone,
        protected string $fax,
        protected string $email,
        protected string $tag,
        protected array $additionalParams,
        protected ?bool $disclose = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'alias' => $this->alias,
            'street' => $this->street,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'telephone' => $this->telephone,
            'fax' => $this->fax,
            'email' => $this->email,
            'tag' => $this->tag,
            'additionalParams' => $this->additionalParams,
            'disclose' => $this->disclose,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/handle/update';
    }
}
