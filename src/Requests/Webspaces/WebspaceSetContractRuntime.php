<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_webspace_setContractRuntime
 *
 * Ändert die Zahlungslaufzeit für ein Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete
 * verwalten** (api.webspace.manage)<br /><br /><a target="_blank"
 * href="/core/api#webspace/setContractRuntime">In Reseller-Interface öffnen</a>
 */
class WebspaceSetContractRuntime extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  int  $contractRuntime  Vertragslaufzeit in Monaten
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     */
    public function __construct(
        protected int $webspace,
        protected int $contractRuntime,
        protected ?int $paymentRuntime = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['webspace' => $this->webspace, 'contractRuntime' => $this->contractRuntime, 'paymentRuntime' => $this->paymentRuntime]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/setContractRuntime';
    }
}
