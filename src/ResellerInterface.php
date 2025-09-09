<?php

namespace TeamNiftyGmbH\ResellerInterface;

use Saloon\Contracts\Authenticator;
use Saloon\Http\Connector;
use Saloon\Traits\Auth\AuthenticatesRequests;
use Saloon\Traits\Makeable;
use TeamNiftyGmbH\ResellerInterface\Auth\ResellerInterfaceAuthenticator;
use TeamNiftyGmbH\ResellerInterface\Resource\Affiliates;
use TeamNiftyGmbH\ResellerInterface\Resource\Auth;
use TeamNiftyGmbH\ResellerInterface\Resource\Batch;
use TeamNiftyGmbH\ResellerInterface\Resource\Benutzer;
use TeamNiftyGmbH\ResellerInterface\Resource\Billing;
use TeamNiftyGmbH\ResellerInterface\Resource\Dns;
use TeamNiftyGmbH\ResellerInterface\Resource\DomainContent;
use TeamNiftyGmbH\ResellerInterface\Resource\DomainParking;
use TeamNiftyGmbH\ResellerInterface\Resource\Domains;
use TeamNiftyGmbH\ResellerInterface\Resource\Emails;
use TeamNiftyGmbH\ResellerInterface\Resource\Ens;
use TeamNiftyGmbH\ResellerInterface\Resource\Files;
use TeamNiftyGmbH\ResellerInterface\Resource\FlexDns;
use TeamNiftyGmbH\ResellerInterface\Resource\Gdpr;
use TeamNiftyGmbH\ResellerInterface\Resource\Handles;
use TeamNiftyGmbH\ResellerInterface\Resource\Invoices;
use TeamNiftyGmbH\ResellerInterface\Resource\Logs;
use TeamNiftyGmbH\ResellerInterface\Resource\Maintenance;
use TeamNiftyGmbH\ResellerInterface\Resource\MessageQueue;
use TeamNiftyGmbH\ResellerInterface\Resource\Payments;
use TeamNiftyGmbH\ResellerInterface\Resource\Prices;
use TeamNiftyGmbH\ResellerInterface\Resource\Products;
use TeamNiftyGmbH\ResellerInterface\Resource\ResellerPrices;
use TeamNiftyGmbH\ResellerInterface\Resource\Resellers;
use TeamNiftyGmbH\ResellerInterface\Resource\Rights;
use TeamNiftyGmbH\ResellerInterface\Resource\Settings;
use TeamNiftyGmbH\ResellerInterface\Resource\Ssl;
use TeamNiftyGmbH\ResellerInterface\Resource\Statistics;
use TeamNiftyGmbH\ResellerInterface\Resource\Tickets;
use TeamNiftyGmbH\ResellerInterface\Resource\Tlds;
use TeamNiftyGmbH\ResellerInterface\Resource\Users;
use TeamNiftyGmbH\ResellerInterface\Resource\Vns;
use TeamNiftyGmbH\ResellerInterface\Resource\Webspaces;

class ResellerInterface extends Connector
{
    use AuthenticatesRequests;
    use Makeable;

    /**
     * @param  string|null  $resellerId
     * @param  string  $coreSid
     */
    public function __construct(
        protected ?string $username = null,
        protected ?string $password = null,
        protected ?int $resellerId = null,
        protected ?string $baseUrl = null,
    ) {}

    public function affiliates(): Affiliates
    {
        return new Affiliates($this);
    }

    public function auth(): Auth
    {
        return new Auth($this);
    }

    public function batch(): Batch
    {
        return new Batch($this);
    }

    public function benutzer(): Benutzer
    {
        return new Benutzer($this);
    }

    public function billing(): Billing
    {
        return new Billing($this);
    }

    public function dns(): Dns
    {
        return new Dns($this);
    }

    public function domainContent(): DomainContent
    {
        return new DomainContent($this);
    }

    public function domainParking(): DomainParking
    {
        return new DomainParking($this);
    }

    public function domains(): Domains
    {
        return new Domains($this);
    }

    public function emails(): Emails
    {
        return new Emails($this);
    }

    public function ens(): Ens
    {
        return new Ens($this);
    }

    public function files(): Files
    {
        return new Files($this);
    }

    public function flexDns(): FlexDns
    {
        return new FlexDns($this);
    }

    public function gdpr(): Gdpr
    {
        return new Gdpr($this);
    }

    public function handles(): Handles
    {
        return new Handles($this);
    }

    public function invoices(): Invoices
    {
        return new Invoices($this);
    }

    public function logs(): Logs
    {
        return new Logs($this);
    }

    public function maintenance(): Maintenance
    {
        return new Maintenance($this);
    }

    public function messageQueue(): MessageQueue
    {
        return new MessageQueue($this);
    }

    public function payments(): Payments
    {
        return new Payments($this);
    }

    public function prices(): Prices
    {
        return new Prices($this);
    }

    public function products(): Products
    {
        return new Products($this);
    }

    public function resellerPrices(): ResellerPrices
    {
        return new ResellerPrices($this);
    }

    public function resellers(): Resellers
    {
        return new Resellers($this);
    }

    public function resolveBaseUrl(): string
    {
        return $this->baseUrl ?? config('resellerinterface.base_url') ?? 'https://core.resellerinterface.de';
    }

    public function rights(): Rights
    {
        return new Rights($this);
    }

    public function settings(): Settings
    {
        return new Settings($this);
    }

    public function ssl(): Ssl
    {
        return new Ssl($this);
    }

    public function statistics(): Statistics
    {
        return new Statistics($this);
    }

    public function tickets(): Tickets
    {
        return new Tickets($this);
    }

    public function tlds(): Tlds
    {
        return new Tlds($this);
    }

    public function users(): Users
    {
        return new Users($this);
    }

    public function vns(): Vns
    {
        return new Vns($this);
    }

    public function webspaces(): Webspaces
    {
        return new Webspaces($this);
    }

    public function withAuthentication(string $username, string $password, ?int $resellerId = null, ?string $sms = null, ?string $totp = null): self
    {
        return $this->authenticate(
            new ResellerInterfaceAuthenticator(
                username: $username,
                password: $password,
                initialResellerId: $resellerId,
                sms: $sms,
                totp: $totp
            )
        );
    }

    protected function defaultAuth(): ?Authenticator
    {
        // Use credentials from constructor, fallback to config
        $username = $this->username ?? config('resellerinterface.username');
        $password = $this->password ?? config('resellerinterface.password');
        $resellerId = $this->resellerId ?? (config('resellerinterface.reseller_id') ? (int) config('resellerinterface.reseller_id') : null);

        // If no credentials available, return null (no authentication)
        if (! $username || ! $password) {
            return null;
        }

        return new ResellerInterfaceAuthenticator(
            username: $username,
            password: $password,
            initialResellerId: $resellerId
        );
    }
}
