<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Handles;

use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;
use TeamNiftyGmbH\ResellerInterface\Enums\ResellerID;

/**
 * post_handle_list
 *
 * Listet alle Handles auf<br>
 * • Es werden maximal 1000 Einträge zurückgegeben<br /><br
 * />Benötigte Rechte:<br />**Handles einsehen** (api.handle.view)<br /><br /><a target="_blank"
 * href="/core/api#handle/list">In Reseller-Interface öffnen</a>
 */
class HandleList extends Request implements Cacheable, HasBody
{
    use HasCaching;
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|ResellerID  $resellerId  Reseller-ID (optional)
     * @param  null|bool  $trustee  Liste auf Trustee-Handles beschränken (optional)
     * @param  null|array  $search  Suchwort (optional)
     * @param  null|array  $filter  Filterbereich (optional)
     * @param  null|array  $sort  Sortierung (optional)
     * @param  null|int  $offset  Offset (optional)
     * @param  null|int  $limit  Limit (optional)
     */
    public function __construct(
        protected ?ResellerID $resellerId = null,
        protected ?bool $trustee = null,
        protected ?array $search = null,
        protected ?array $filter = null,
        protected ?array $sort = null,
        protected ?int $offset = null,
        protected ?int $limit = null,
    ) {}

    public function cacheExpiryInSeconds(): int
    {
        return 3600;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'resellerID' => $this->resellerId?->value,
            'trustee' => $this->trustee,
            'search' => $this->search,
            'filter' => $this->filter,
            'sort' => $this->sort,
            'offset' => $this->offset,
            'limit' => $this->limit,
        ]);
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(cache()->store());
    }

    public function resolveEndpoint(): string
    {
        return '/handle/list';
    }

    protected function cacheKey(mixed ...$arguments): ?string
    {
        return 'handle_list_' . md5(json_encode($this->defaultBody()));
    }
}
