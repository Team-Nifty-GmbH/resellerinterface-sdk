<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_updateRedirectTargetByDomain
 *
 * Aktualisiert das Weiterleitungsziel mehrerer E-Mail-Adressen<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br /><a target="_blank"
 * href="/core/api#mail/updateRedirectTargetByDomain">In Reseller-Interface öffnen</a>
 */
class MailUpdateRedirectTargetByDomain extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $domain  Domainname (sld.tld)
     * @param  null|string  $local  Lokaler Teil (optional)
     * @param  string  $oldTarget  Altes Ziel
     * @param  string  $newTarget  Neues Ziel
     */
    public function __construct(
        protected string $domain,
        protected ?string $local,
        protected string $oldTarget,
        protected string $newTarget,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['domain' => $this->domain, 'local' => $this->local, 'oldTarget' => $this->oldTarget, 'newTarget' => $this->newTarget]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/updateRedirectTargetByDomain';
    }
}
