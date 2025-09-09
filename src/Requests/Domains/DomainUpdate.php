<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Domains;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Dto\Order;

/**
 * post_domain_update
 *
 * Ändert/aktualisiert die bei der Registry hinterlegten Datensätze<br /><br />Benötigte Rechte:<br
 * />**Domains verwalten** (api.domain.manage)<br /><br /><a target="_blank"
 * href="/core/api#domain/update">In Reseller-Interface öffnen</a>
 */
class DomainUpdate extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  null|array  $handles  Handles (optional) [[domain/setHandles](#post-/domain/setHandles)]
     * @param  null|bool  $tradeOk  erlaubt einen (evtl. kostenpflichtigen) Inhaberwechsel (optional)
     * @param  null|array  $nameserver  Nameserver (optional) [[domain/setNameserver](#post-/domain/setNameserver)]
     * @param  null|int  $ensId  ID eines externen Nameserver-Sets (optional)
     * @param  null|array  $dnssec  öffentliche DNSSEC Schlüssel (optional) [[domain/setDnssec](#post-/domain/setDnssec)]
     * @param  null|bool  $trustee  Trustee hinzufügen (true) oder vorhandenen Trustee entfernen (false) (optional)
     * @param  null|bool  $whoisPrivacy  Whois-Schutz hinzufügen (true) oder vorhandenen Whois-Schutz entfernen (false) (optional)
     * @param  null|bool  $fullyAsync  Einen Auftrag erstellen, der vollständig im Hintergrund verarbeitet wird, um diesen API-Aufruf signifikant zu beschleunigen. Die Rückgabe enthält in diesem Fall nur den Auftrag (order-Objekt) (optional)
     */
    public function __construct(
        protected int $domain,
        protected ?array $handles = null,
        protected ?bool $tradeOk = null,
        protected ?array $nameserver = null,
        protected ?int $ensId = null,
        protected ?array $dnssec = null,
        protected ?bool $trustee = null,
        protected ?bool $whoisPrivacy = null,
        protected ?bool $fullyAsync = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return Order::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter([
            'domain' => $this->domain,
            'handles' => $this->handles,
            'tradeOK' => $this->tradeOk,
            'nameserver' => $this->nameserver,
            'ensID' => $this->ensId,
            'dnssec' => $this->dnssec,
            'trustee' => $this->trustee,
            'whoisPrivacy' => $this->whoisPrivacy,
            'fullyAsync' => $this->fullyAsync,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/domain/update';
    }
}
