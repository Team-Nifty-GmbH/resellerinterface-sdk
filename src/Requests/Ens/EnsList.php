<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Ens;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_ens_list
 *
 * <br /><br /><a target="_blank" href="/core/api#ens/list">In Reseller-Interface öffnen</a>
 */
class EnsList extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $resellerId  Reseller-ID (optional)
     */
    public function __construct(
        protected ?int $resellerId = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['resellerID' => $this->resellerId]);
    }

    public function resolveEndpoint(): string
    {
        return '/ens/list';
    }
}
