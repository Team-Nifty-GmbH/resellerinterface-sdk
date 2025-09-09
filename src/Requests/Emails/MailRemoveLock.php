<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_removeLock
 *
 * Fordert die Entsperrung einer E-Mail-Adresse an<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/removeLock">In Reseller-Interface öffnen</a>
 */
class MailRemoveLock extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     * @param  string  $document  Freischaltvereinbarung
     */
    public function __construct(
        protected int $eMailAddressId,
        protected string $document,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['eMailAddressID' => $this->eMailAddressId, 'document' => $this->document]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/removeLock';
    }
}
