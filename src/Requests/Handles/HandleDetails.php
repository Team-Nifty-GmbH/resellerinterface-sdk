<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Handles;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Handle;

/**
 * post_handle_details
 *
 * Gibt alle Infos zu einem Handledatensatz aus<br /><br />Benötigte Rechte:<br />**Handles einsehen**
 * (api.handle.view)<br /><br /><a target="_blank" href="/core/api#handle/details">In
 * Reseller-Interface öffnen</a>
 */
class HandleDetails extends Request implements HasBody
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
        return Handle::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['alias' => $this->alias]);
    }

    public function resolveEndpoint(): string
    {
        return '/handle/details';
    }
}
