<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_mail_create
 *
 * Erstellt eine neue E-Mail-Adresse<br /><br />Benötigte Rechte:<br />**E-Mail-Weiterleitungen
 * anlegen** (api.email.order)<br /><br /><a target="_blank" href="/core/api#mail/create">In
 * Reseller-Interface öffnen</a>
 */
class MailCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $eMailAddress  E-Mail-Adresse (optional)
     * @param  null|string  $local  Lokaler Teil (optional)
     * @param  string  $domain  Domainname (sld.tld)
     * @param  Type  $type  E-Mail-Typ
     * @param  null|string  $comment  Kommentar (optional)
     * @param  null|string  $webspace  Webspace (optional)
     * @param  null|int  $inboxId  E-Mail-Postfach ID (optional)
     * @param  null|array  $redirectEmailAddresses  E-Mail-Adressen, zu denen weitergeleitet werden soll (optional)
     */
    public function __construct(
        protected ?string $eMailAddress,
        protected ?string $local,
        protected string $domain,
        protected Type $type,
        protected ?string $comment = null,
        protected ?string $webspace = null,
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
            'eMailAddress' => $this->eMailAddress,
            'local' => $this->local,
            'domain' => $this->domain,
            'type' => $this->type->value,
            'comment' => $this->comment,
            'webspace' => $this->webspace,
            'inboxID' => $this->inboxId,
            'redirectEMailAddresses' => $this->redirectEmailAddresses,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/create';
    }
}
