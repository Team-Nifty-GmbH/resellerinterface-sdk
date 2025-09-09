<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Logs;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;

/**
 * post_log_get
 *
 * Ruft Log-Einträge ab<br>
 * • Es werden maximal die 100 letzten Einträge der vergangenen 12 Monate
 * angezeigt.<br /><br />Benötigte Rechte:<br />**Protokolle einsehen** (api.log.view)<br /><br /><a
 * target="_blank" href="/core/api#log/get">In Reseller-Interface öffnen</a>
 */
class LogGet extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|int  $forResellerId  Reseller-ID (optional)
     * @param  null|int  $resellerId  Reseller-ID (optional)
     * @param  null|int  $userId  Benutzer-ID (optional)
     * @param  null|string  $dateFrom  Von Zeitpunkt (optional)
     * @param  null|string  $dateTill  Bis Zeitpunkt (optional)
     * @param  null|Type  $type  Objekt-Typ (optional)
     * @param  null|int  $typeId  Objekt-ID (optional)
     * @param  null|string  $typeName  Objekt-Bezeichnung (optional)
     */
    public function __construct(
        protected ?int $forResellerId = null,
        protected ?int $resellerId = null,
        protected ?int $userId = null,
        protected ?string $dateFrom = null,
        protected ?string $dateTill = null,
        protected ?Type $type = null,
        protected ?int $typeId = null,
        protected ?string $typeName = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'forResellerID' => $this->forResellerId,
            'resellerID' => $this->resellerId,
            'userID' => $this->userId,
            'dateFrom' => $this->dateFrom,
            'dateTill' => $this->dateTill,
            'type' => $this->type?->value,
            'typeID' => $this->typeId,
            'typeName' => $this->typeName,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/log/get';
    }
}
