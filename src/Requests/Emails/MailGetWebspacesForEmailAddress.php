<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_getWebspacesForEMailAddress
 *
 * Ruft Webspace-Pakete ab, welche für eine E-Mail-Adresse in Frage kommen<br /><br />Benötigte
 * Rechte:<br />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/getWebspacesForEMailAddress">In Reseller-Interface öffnen</a>
 */
class MailGetWebspacesForEmailAddress extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $eMailAddress  E-Mail-Adresse
     * @param  string  $domain  Domainname (sld.tld)
     */
    public function __construct(
        protected string $eMailAddress,
        protected string $domain,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['eMailAddress' => $this->eMailAddress, 'domain' => $this->domain]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/getWebspacesForEMailAddress';
    }
}
