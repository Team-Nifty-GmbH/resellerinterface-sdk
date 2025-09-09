<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_mail_createSpamFilterRule
 *
 * Legt eine Filterregel für den Spamfilter an<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/createSpamFilterRule">In Reseller-Interface öffnen</a>
 */
class MailCreateSpamFilterRule extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $eMailAddressId  ID der E-Mail-Adresse (optional)
     * @param  null|string  $domain  Domainname (sld.tld) (optional)
     * @param  Type  $type  Typ der Filterregel
     * @param  string  $senderAddress  Absender-E-Mail-Adresse
     */
    public function __construct(
        protected ?int $eMailAddressId,
        protected ?string $domain,
        protected Type $type,
        protected string $senderAddress,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'eMailAddressID' => $this->eMailAddressId,
            'domain' => $this->domain,
            'type' => $this->type->value,
            'senderAddress' => $this->senderAddress,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/createSpamFilterRule';
    }
}
