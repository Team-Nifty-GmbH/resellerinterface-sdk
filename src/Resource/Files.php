<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Requests\Files\FileDownload;
use TeamNiftyGmbH\ResellerInterface\Requests\Files\FileDownloadByTag;

class Files extends BaseResource
{
    /**
     * @param  int  $fileId  Datei-ID
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function fileDownload(int $fileId): Response
    {
        return $this->connector->send(new FileDownload($fileId));
    }

    /**
     * @param  int  $tag  Tag
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function fileDownloadByTag(int $tag): Response
    {
        return $this->connector->send(new FileDownloadByTag($tag));
    }
}
