<?php

namespace TeamNiftyGmbH\ResellerInterface\Auth;

use RuntimeException;
use Saloon\Contracts\Authenticator;
use Saloon\Http\PendingRequest;
use TeamNiftyGmbH\ResellerInterface\Requests\Resellers\ResellerLogin;
use TeamNiftyGmbH\ResellerInterface\ResellerInterface;

class ResellerInterfaceAuthenticator implements Authenticator
{
    protected ?string $coreSID = null;

    protected ?int $resellerId = null;

    public function __construct(
        protected string $username,
        protected string $password,
        protected ?int $initialResellerId = null,
        protected ?string $sms = null,
        protected ?string $totp = null
    ) {
        $this->resellerId = $this->initialResellerId;
    }

    /**
     * Clear the authentication state (force re-login on next request)
     */
    public function clearAuth(): void
    {
        $this->coreSID = null;
    }

    /**
     * Get the current core session ID
     */
    public function getCoreSID(): ?string
    {
        return $this->coreSID;
    }

    /**
     * Get the current reseller ID
     */
    public function getResellerId(): ?int
    {
        return $this->resellerId;
    }

    public function set(PendingRequest $pendingRequest): void
    {
        // Skip authentication for login request itself
        if ($pendingRequest->getRequest() instanceof ResellerLogin) {
            return;
        }

        if (! $this->coreSID) {
            $this->performLogin($pendingRequest->getConnector());
        }

        if ($this->coreSID) {
            $pendingRequest->headers()->add('Cookie', 'coreSID=' . $this->coreSID);
        }

        if ($this->resellerId) {
            $pendingRequest->body()->add('resellerId', $this->resellerId);
        }
    }

    protected function performLogin($connector): void
    {
        if (! $connector instanceof ResellerInterface) {
            throw new RuntimeException('Connector must be an instance of ResellerInterface');
        }

        // Create login request directly to avoid circular dependency
        $loginRequest = new ResellerLogin(
            username: $this->username,
            password: $this->password,
            sms: $this->sms,
            totp: $this->totp
        );

        // Send without authentication to avoid circular dependency
        $response = $connector->send($loginRequest);

        if (! $response->successful()) {
            throw new RuntimeException('Authentication failed: ' . $response->body());
        }

        $data = $response->json();

        if (isset($data['coreSID'])) {
            $this->coreSID = $data['coreSID'];
        } else {
            // Fallback: Extract session ID from cookies
            $cookies = $response->header('Set-Cookie');
            if ($cookies && preg_match('/coreSID=([^;]+)/', $cookies, $matches)) {
                $this->coreSID = $matches[1];
            }
        }

        if (! $this->resellerId && isset($data['reseller']['resellerID'])) {
            $this->resellerId = (int) $data['reseller']['resellerID'];
        }
    }
}
