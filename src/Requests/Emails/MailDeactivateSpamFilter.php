<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_deactivateSpamFilter
 *
 * Deaktiviert den Spamfilter<br /><br />Benötigte Rechte:<br />**E-Mail-Weiterleitungen verwalten**
 * (api.email.manage)<br /><br /><a target="_blank" href="/core/api#mail/deactivateSpamFilter">In
 * Reseller-Interface öffnen</a>
 */
class MailDeactivateSpamFilter extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $eMailAddressId  ID der E-Mail-Adresse (optional)
     * @param  null|string  $domain  Domainname (sld.tld) (optional)
     * @param  null|bool  $deactivate  (optional)
     */
    public function __construct(
        protected ?int $eMailAddressId = null,
        protected ?string $domain = null,
        protected ?bool $deactivate = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['eMailAddressID' => $this->eMailAddressId, 'domain' => $this->domain, 'deactivate' => $this->deactivate]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/deactivateSpamFilter';
    }
}
