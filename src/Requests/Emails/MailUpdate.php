<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_mail_update
 *
 * Aktualisiert die Informationen einer E-Mail-Adresse<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/update">In Reseller-Interface öffnen</a>
 */
class MailUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     * @param  null|string  $eMailAddress  E-Mail-Adresse (optional)
     * @param  null|string  $local  Lokaler Teil (optional)
     * @param  null|string  $domain  Domainname (sld.tld) (optional)
     * @param  null|Type  $type  E-Mail-Typ (optional)
     * @param  null|string  $webspace  Webspace (optional)
     * @param  null|string  $comment  Kommentar (optional)
     * @param  null|string  $password  Passwort (optional)
     * @param  null|int  $inboxId  E-Mail-Postfach ID (optional)
     * @param  null|array  $redirectEmailAddresses  E-Mail-Adressen, zu denen weitergeleitet werden soll (optional)
     */
    public function __construct(
        protected int $eMailAddressId,
        protected ?string $eMailAddress = null,
        protected ?string $local = null,
        protected ?string $domain = null,
        protected ?Type $type = null,
        protected ?string $webspace = null,
        protected ?string $comment = null,
        protected ?string $password = null,
        protected ?int $inboxId = null,
        protected ?array $redirectEmailAddresses = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'eMailAddressID' => $this->eMailAddressId,
            'eMailAddress' => $this->eMailAddress,
            'local' => $this->local,
            'domain' => $this->domain,
            'type' => $this->type?->value,
            'webspace' => $this->webspace,
            'comment' => $this->comment,
            'password' => $this->password,
            'inboxID' => $this->inboxId,
            'redirectEMailAddresses' => $this->redirectEmailAddresses,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/update';
    }
}
