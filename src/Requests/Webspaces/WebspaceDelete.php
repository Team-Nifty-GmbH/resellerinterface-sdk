<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Webspace;

/**
 * post_webspace_delete
 *
 * Kündigt ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete kündigen**
 * (api.webspace.delete)<br /><br /><a target="_blank" href="/core/api#webspace/delete">In
 * Reseller-Interface öffnen</a>
 */
class WebspaceDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|string  $date  Datum (optional)
     * @param  null|string  $reason  Grund der Kündigung (optional)
     */
    public function __construct(
        protected int $webspace,
        protected ?string $date = null,
        protected ?string $reason = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Webspace::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'date' => $this->date, 'reason' => $this->reason]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/delete';
    }
}
