<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Files;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_file_download
 *
 * Fordert eine Datei vom Dateiserver an<br /><br /><a target="_blank"
 * href="/core/api#file/download">In Reseller-Interface öffnen</a>
 */
class FileDownload extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  int  $fileId  Datei-ID
     */
    public function __construct(
        protected int $fileId,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter(['fileID' => $this->fileId]);
    }

    public function resolveEndpoint(): string
    {
        return '/file/download';
    }
}
