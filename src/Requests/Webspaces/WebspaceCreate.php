<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Webspace;

/**
 * post_webspace_create
 *
 * Erstellt ein neues Webspace<br /><br />Benötigte Rechte:<br />**Webspacepakete bestellen**
 * (api.webspace.order)<br /><br /><a target="_blank" href="/core/api#webspace/create">In
 * Reseller-Interface öffnen</a>
 */
class WebspaceCreate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|string  $package  Status-Filter (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     */
    public function __construct(
        protected ?int $runtime = null,
        protected ?int $paymentRuntime = null,
        protected ?string $package = null,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Webspace::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'runtime' => $this->runtime,
            'paymentRuntime' => $this->paymentRuntime,
            'package' => $this->package,
            'fullyAsync' => $this->fullyAsync,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/create';
    }
}
