<?php

namespace TeamNiftyGmbH\ResellerInterface\Resource;

use Saloon\Exceptions\Request\FatalRequestException;
use Saloon\Exceptions\Request\RequestException;
use Saloon\Http\BaseResource;
use Saloon\Http\Response;
use TeamNiftyGmbH\ResellerInterface\Enums\Type;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentActivate;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentDelete;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentDeleteTemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentGet;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentGetActive;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentGetConflicts;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentGetTemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentList;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentPreview;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentPreviewTemplate;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentSet;
use TeamNiftyGmbH\ResellerInterface\Requests\DomainContent\DomainContentSetTemplate;

class DomainContent extends BaseResource
{
    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  null|bool  $force  Aktivierung erzwingen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentActivate(int $domain, string $type, ?bool $force = null): Response
    {
        return $this->connector->send(new DomainContentActivate($domain, $type, $force));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentDelete(int $domain, string $type): Response
    {
        return $this->connector->send(new DomainContentDelete($domain, $type));
    }

    /**
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentDeleteTemplate(string $type): Response
    {
        return $this->connector->send(new DomainContentDeleteTemplate($type));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentGet(int $domain, string $type): Response
    {
        return $this->connector->send(new DomainContentGet($domain, $type));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentGetActive(int $domain): Response
    {
        return $this->connector->send(new DomainContentGetActive($domain));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentGetConflicts(int $domain): Response
    {
        return $this->connector->send(new DomainContentGetConflicts($domain));
    }

    /**
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentGetTemplate(string $type): Response
    {
        return $this->connector->send(new DomainContentGetTemplate($type));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentList(int $domain): Response
    {
        return $this->connector->send(new DomainContentList($domain));
    }

    /**
     * @param  int  $domainId  Domain-ID
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  null|array  $data  Content-Daten (optional)
     * @param  null|int  $cardId  Web-Visitenkarten-ID (optional)
     * @param  null|int  $sellId  Verkaufsagent-ID (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentPreview(
        int $domainId,
        string $type,
        ?array $data = null,
        ?int $cardId = null,
        ?int $sellId = null,
    ): Response {
        return $this->connector->send(new DomainContentPreview($domainId, $type, $data, $cardId, $sellId));
    }

    /**
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  array  $data  Content-Daten
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentPreviewTemplate(string $type, array $data): Response
    {
        return $this->connector->send(new DomainContentPreviewTemplate($type, $data));
    }

    /**
     * @param  int  $domain  Domain-ID oder Domainname
     * @param  Type  $type  Content-Typ
     * @param  null|array  $data  Content-Daten (optional)
     * @param  null|int  $cardId  Web-Visitenkarten-ID (optional)
     * @param  null|int  $sellId  Verkaufsagent-ID (optional)
     * @param  null|bool  $activate  aktivieren (optional)
     * @param  null|bool  $force  Aktivierung erzwingen (optional)
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentSet(
        int $domain,
        Type $type,
        ?array $data = null,
        ?int $cardId = null,
        ?int $sellId = null,
        ?bool $activate = null,
        ?bool $force = null,
    ): Response {
        return $this->connector->send(new DomainContentSet($domain, $type, $data, $cardId, $sellId, $activate, $force));
    }

    /**
     * @param  string  $type  Content-Typ [[domainContent/set](#post-/domainContent/set)]
     * @param  array  $data  Content-Daten
     *
     * @throws FatalRequestException
     * @throws RequestException
     */
    public function domainContentSetTemplate(string $type, array $data): Response
    {
        return $this->connector->send(new DomainContentSetTemplate($type, $data));
    }
}
