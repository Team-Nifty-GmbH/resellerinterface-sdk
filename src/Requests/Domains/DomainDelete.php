<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Domain;

/**
 * post_domain_delete
 *
 * Hinterlegt die Löschung der Domain zum angegebenen Datum<br /><br />Benötigte Rechte:<br
 * />**Domains kündigen** (api.domain.delete)<br /><br /><a target="_blank"
 * href="/core/api#domain/delete">In Reseller-Interface öffnen</a>
 */
class DomainDelete extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|string  $date  Datum (optional)
     * @param  null|bool  $transit  Transit ausführen (optional)
     * @param  null|bool  $disconnect  Diskonnektieren (optional)
     * @param  null|string  $sms  TwoFA SMS-Code (optional)
     * @param  null|string  $totp  TwoFA TOTP-Code (optional)
     * @param  null|string  $reason  Grund der Kündigung (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?string $date = null,
        protected ?bool $transit = null,
        protected ?bool $disconnect = null,
        protected ?string $sms = null,
        protected ?string $totp = null,
        protected ?string $reason = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Domain::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'date' => $this->date,
            'transit' => $this->transit,
            'disconnect' => $this->disconnect,
            'sms' => $this->sms,
            'totp' => $this->totp,
            'reason' => $this->reason,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/delete';
    }
}
