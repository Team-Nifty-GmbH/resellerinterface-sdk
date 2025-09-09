<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_getDomainsForEMailAddressUpdate
 *
 * Ruft Domains ab, welche für ein E-Mail-Adressen-Update in frage kommen<br /><br />Benötigte
 * Rechte:<br />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/getDomainsForEMailAddressUpdate">In Reseller-Interface öffnen</a>
 */
class MailGetDomainsForEmailAddressUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $eMailAddressId  ID der E-Mail-Adresse
     */
    public function __construct(
        protected int $eMailAddressId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['eMailAddressID' => $this->eMailAddressId]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/getDomainsForEMailAddressUpdate';
    }
}
