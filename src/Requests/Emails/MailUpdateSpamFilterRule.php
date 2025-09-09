<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_mail_updateSpamFilterRule
 *
 * Aktualisiert eine Filterregel für den Spamfilter<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/updateSpamFilterRule">In Reseller-Interface öffnen</a>
 */
class MailUpdateSpamFilterRule extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $spamFilterRuleId  Filterregel-ID
     * @param  null|Type  $type  Typ der Filterregel (optional)
     * @param  null|string  $senderAddress  Absender-E-Mail-Adresse (optional)
     */
    public function __construct(
        protected int $spamFilterRuleId,
        protected ?Type $type = null,
        protected ?string $senderAddress = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['spamFilterRuleID' => $this->spamFilterRuleId, 'type' => $this->type?->value, 'senderAddress' => $this->senderAddress]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/updateSpamFilterRule';
    }
}
