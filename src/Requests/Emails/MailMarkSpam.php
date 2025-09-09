<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_markSpam
 *
 * <br /><br />Benötigte Rechte:<br />**E-Mail-Weiterleitungen verwalten** (api.email.manage)<br /><br
 * /><a target="_blank" href="/core/api#mail/markSpam">In Reseller-Interface öffnen</a>
 */
class MailMarkSpam extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    public function __construct(
        protected string $file,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['file' => $this->file]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/markSpam';
    }
}
