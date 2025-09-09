<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Tlds;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_tld_details
 *
 * Detailierte Informationen zu einer TLD<br /><br /><a target="_blank" href="/core/api#tld/details">In
 * Reseller-Interface öffnen</a>
 */
class TldDetails extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $tld  Top-Level-Domain
     */
    public function __construct(
        protected string $tld,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['tld' => $this->tld]);
    }

    public function resolveEndpoint(): string
    {
        return '/tld/details';
    }
}
