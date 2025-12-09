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
use TeamNiftyGmbH\ResellerInterface\Dto\Handle;

/**
 * post_handle_details
 *
 * Gibt alle Infos zu einem Handledatensatz aus<br /><br />Benötigte Rechte:<br />**Handles einsehen**
 * (api.handle.view)<br /><br /><a target="_blank" href="/core/api#handle/details">In
 * Reseller-Interface öffnen</a>
 */
class HandleDetails extends Request implements Cacheable, HasBody
{
    use HasCaching;
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  string  $alias  Alias
     */
    public function __construct(
        protected string $alias,
    ) {}

    public function cacheExpiryInSeconds(): int
    {
        // Cache handle details for 1 hour
        return 3600;
    }

    public function createDtoFromResponse(Response $response): mixed
    {
        return Handle::from($response->json() ?? []);
    }

    public function defaultBody(): array
    {
        return array_filter(['alias' => $this->alias]);
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(cache()->store());
    }

    public function resolveEndpoint(): string
    {
        return '/handle/details';
    }

    protected function cacheKey(mixed ...$arguments): ?string
    {
        return 'handle_details_' . $this->alias;
    }
}
