<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Handles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_handle_deactivate
 *
 * Blendet ein Handle aus<br /><br />Benötigte Rechte:<br />**Handles verwalten**
 * (api.handle.manage)<br /><br /><a target="_blank" href="/core/api#handle/deactivate">In
 * Reseller-Interface öffnen</a>
 */
class HandleDeactivate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $alias  Alias
     */
    public function __construct(
        protected string $alias,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['alias' => $this->alias]);
    }

    public function resolveEndpoint(): string
    {
        return '/handle/deactivate';
    }
}
