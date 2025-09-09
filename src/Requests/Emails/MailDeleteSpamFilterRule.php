<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_deleteSpamFilterRule
 *
 * Löscht eine Filterregel für den Spamfilter<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/deleteSpamFilterRule">In Reseller-Interface öffnen</a>
 */
class MailDeleteSpamFilterRule extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $spamFilterRuleId  Filterregel-ID
     */
    public function __construct(
        protected int $spamFilterRuleId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['spamFilterRuleID' => $this->spamFilterRuleId]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/deleteSpamFilterRule';
    }
}
