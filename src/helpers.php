<?php

use TeamNiftyGmbH\ResellerInterface\ResellerInterface;

if (! function_exists('resellerInterface')) {
    /**
     * Get a ResellerInterface SDK instance
     *
     * @param  string|null  $username  Override default username
     * @param  string|null  $password  Override default password
     * @param  int|null  $resellerId  Override default reseller ID
     */
    function resellerInterface(?string $username = null, ?string $password = null, ?int $resellerId = null): ResellerInterface
    {
        // Check if we're in Laravel
        $inLaravel = function_exists('app') && class_exists('\Illuminate\Foundation\Application');

        if ($inLaravel) {
            // If no overrides provided and container has instance, return singleton
            if ($username === null && $password === null && $resellerId === null && app()->has(ResellerInterface::class)) {
                return app(ResellerInterface::class);
            }

            // Use Laravel config for defaults
            return new ResellerInterface(
                username: $username ?? config('resellerinterface.username'),
                password: $password ?? config('resellerinterface.password'),
                resellerId: $resellerId ?? (config('resellerinterface.reseller_id') ? (int) config('resellerinterface.reseller_id') : null),
                baseUrl: config('resellerinterface.base_url')
            );
        }

        // Not in Laravel, create with provided credentials only
        return new ResellerInterface(
            username: $username,
            password: $password,
            resellerId: $resellerId
        );
    }
}
