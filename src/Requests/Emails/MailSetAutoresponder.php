<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Status;

/**
 * post_mail_setAutoresponder
 *
 * Aktiviert und deaktiviert den Autoresponder für Postfächer<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/setAutoresponder">In Reseller-Interface öffnen</a>
 */
class MailSetAutoresponder extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     * @param  null|Status  $status  Status des Autoresponders (optional)
     * @param  null|string  $name  Name (optional)
     * @param  null|string  $subject  Betreff (optional)
     * @param  null|string  $text  Nachricht (optional)
     * @param  null|string  $dateStart  Von Zeitpunkt (optional)
     * @param  string  $dateEnd  Bis Zeitpunkt
     */
    public function __construct(
        protected int $eMailAddressId,
        protected ?Status $status,
        protected ?string $name,
        protected ?string $subject,
        protected ?string $text,
        protected ?string $dateStart,
        protected string $dateEnd,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'eMailAddressID' => $this->eMailAddressId,
            'status' => $this->status?->value,
            'name' => $this->name,
            'subject' => $this->subject,
            'text' => $this->text,
            'dateStart' => $this->dateStart,
            'dateEnd' => $this->dateEnd,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/setAutoresponder';
    }
}
