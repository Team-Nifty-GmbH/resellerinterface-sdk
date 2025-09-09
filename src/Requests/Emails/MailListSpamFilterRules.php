<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Emails;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_mail_listSpamFilterRules
 *
 * Listet Filterregeln für den Spamfilter auf<br /><br />Benötigte Rechte:<br
 * />**E-Mail-Weiterleitungen anzeigen** (api.email.view)<br /><br /><a target="_blank"
 * href="/core/api#mail/listSpamFilterRules">In Reseller-Interface öffnen</a>
 */
class MailListSpamFilterRules extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $eMailAddressId  ID der E-Mail-Adresse (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?int $eMailAddressId = null,
        protected ?array $search = null,
        protected ?array $filter = null,
        protected ?array $sort = null,
        protected ?int $offset = null,
        protected ?int $limit = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'eMailAddressID' => $this->eMailAddressId,
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/mail/listSpamFilterRules';
    }
}
