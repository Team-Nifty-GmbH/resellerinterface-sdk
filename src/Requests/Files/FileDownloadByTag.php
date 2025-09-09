<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Files;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_file_downloadByTag
 *
 * Fordert eine Datei vom Dateiserver an anhand eines Tags<br /><br /><a target="_blank"
 * href="/core/api#file/downloadByTag">In Reseller-Interface öffnen</a>
 */
class FileDownloadByTag extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $tag  Tag
     */
    public function __construct(
        protected int $tag,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['tag' => $this->tag]);
    }

    public function resolveEndpoint(): string
    {
        return '/file/downloadByTag';
    }
}
