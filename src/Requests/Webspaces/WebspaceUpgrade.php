<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Webspaces;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Webspace;

/**
 * post_webspace_upgrade
 *
 * Wertet ein Webspace auf<br /><br />Benötigte Rechte:<br />**Webspacepakete verwalten**
 * (api.webspace.manage)<br /><br /><a target="_blank" href="/core/api#webspace/upgrade">In
 * Reseller-Interface öffnen</a>
 */
class WebspaceUpgrade extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $webspace  ID oder Name des Webspaces
     * @param  null|int  $runtime  Laufzeit in Monaten (optional)
     * @param  null|int  $paymentRuntime  Zahlungsinterval in Monaten (optional)
     * @param  null|string  $package  Status-Filter (optional)
     * @param  bool  $revocationAccepted  Widerrufsrecht akzeptiert
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     */
    public function __construct(
        protected int $webspace,
        protected ?int $runtime,
        protected ?int $paymentRuntime,
        protected ?string $package,
        protected bool $revocationAccepted,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Webspace::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'webspace' => $this->webspace,
            'runtime' => $this->runtime,
            'paymentRuntime' => $this->paymentRuntime,
            'package' => $this->package,
            'revocationAccepted' => $this->revocationAccepted,
            'fullyAsync' => $this->fullyAsync,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/webspace/upgrade';
    }
}
