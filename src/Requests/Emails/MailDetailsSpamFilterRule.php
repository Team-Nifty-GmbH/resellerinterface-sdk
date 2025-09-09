<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_detailsSpamFilterRule
 *
 * Ruft Informationen einer Filterregel für den Spamfilter ab<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen anzeigen** (api.email.view)<br /><br /><a target="_blank"
 * href="/core/api#mail/detailsSpamFilterRule">In Reseller-Interface öffnen</a>
 */
class MailDetailsSpamFilterRule extends Request implements HasBody
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
        return '/mail/detailsSpamFilterRule';
    }
}
