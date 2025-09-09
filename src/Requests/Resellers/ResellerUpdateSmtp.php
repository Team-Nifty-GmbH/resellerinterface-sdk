<?php

namespace TeamNiftyGmbH\ResellerInterface\Requests\Resellers;

use Saloon\Contracts\Body\HasBody;
use Saloon\Enums\Method;
use Saloon\Http\Request;
use Saloon\Http\Response;
use Saloon\Traits\Body\HasFormBody;

/**
 * post_reseller_updateSMTP
 *
 * <br /><br />Benötigte Rechte:<br />**Interfacebranding verwalten** (api.reseller.branding)<br /><br
 * /><a target="_blank" href="/core/api#reseller/updateSMTP">In Reseller-Interface öffnen</a>
 */
class ResellerUpdateSmtp extends Request implements HasBody
{
    use HasFormBody;

    protected Method $method = Method::POST;

    /**
     * @param  null|string  $fromName  (optional)
     * @param  null|string  $replyAddress  (optional)
     * @param  null|string  $replyName  (optional)
     * @param  null|string  $signatureHtml  (optional)
     * @param  null|string  $signatureText  (optional)
     * @param  null|string  $username  (optional)
     * @param  null|string  $password  (optional)
     * @param  null|string  $pgpPrivateKey  (optional)
     * @param  null|string  $pgpPublicKey  Öffentlicher PGP-Schlüssel (ASCII-Format) (optional)
     */
    public function __construct(
        protected ?string $fromName,
        protected ?string $replyAddress,
        protected ?string $replyName,
        protected ?string $signatureHtml,
        protected ?string $signatureText,
        protected string $host,
        protected ?string $username,
        protected ?string $password,
        protected int $port,
        protected string $fromAddress,
        protected string $returnPathAddress,
        protected string $abuseCenterAddress,
        protected ?string $pgpPrivateKey = null,
        protected ?string $pgpPublicKey = null,
    ) {}

    public function createDtoFromResponse(Response $response): mixed
    {
        return $response->json();
    }

    public function defaultBody(): array
    {
        return array_filter([
            'fromName' => $this->fromName,
            'replyAddress' => $this->replyAddress,
            'replyName' => $this->replyName,
            'signatureHtml' => $this->signatureHtml,
            'signatureText' => $this->signatureText,
            'host' => $this->host,
            'username' => $this->username,
            'password' => $this->password,
            'port' => $this->port,
            'fromAddress' => $this->fromAddress,
            'returnPathAddress' => $this->returnPathAddress,
            'abuseCenterAddress' => $this->abuseCenterAddress,
            'pgpPrivateKey' => $this->pgpPrivateKey,
            'pgpPublicKey' => $this->pgpPublicKey,
        ]);
    }

    public function resolveEndpoint(): string
    {
        return '/reseller/updateSMTP';
    }
}
