# ResellerInterface SDK

A modern PHP SDK for the ResellerInterface API, built with [Saloon v3](https://docs.saloon.dev/).

## Features

- 🔐 **Automatic Authentication** - Handles login and session management automatically
- 🚀 **Laravel Integration** - Service Provider, Config, and Helper functions included
- 📦 **Standalone Usage** - Works without Laravel as a standalone PHP package
- 🎯 **Type-Safe** - Full type hints and IDE autocompletion
- ⚡ **Modern PHP** - Requires PHP 8.3+ with constructor property promotion
- 🔄 **Session Management** - Automatic session renewal and cookie handling

## Installation

Install via Composer:

```bash
composer require team-nifty-gmbh/resellerinterface-sdk
```

### Laravel Setup

The package includes Laravel Auto-Discovery, so no manual registration is needed.

Publish the configuration file:

```bash
php artisan vendor:publish --tag=resellerinterface-config
```

Add your credentials to `.env`:

```env
RESELLERINTERFACE_USERNAME=your-username
RESELLERINTERFACE_PASSWORD=your-password
RESELLERINTERFACE_RESELLER_ID=12345
RESELLERINTERFACE_BASE_URL=https://core.resellerinterface.de
```

## Usage

### Quick Start with Helper Function (Laravel)

```php
// Get SDK instance with credentials from config
$sdk = resellerInterface();

// Make API calls
$response = $sdk->domains()->domainList();
$domains = $response->json();
```

### Dependency Injection (Laravel)

```php
use TeamNiftyGmbH\ResellerInterface\ResellerInterface;

class DomainController extends Controller
{
    public function __construct(
        private ResellerInterface $sdk
    ) {}
    
    public function index()
    {
        $response = $this->sdk->domains()->domainList();
        return $response->json();
    }
}
```

### Using Custom Credentials

```php
// Override config credentials
$sdk = resellerInterface(
    username: 'other-user',
    password: 'other-pass',
    resellerId: 67890
);

// Or create instance directly
$sdk = new ResellerInterface(
    username: 'api-user',
    password: 'secret',
    resellerId: 12345
);
```

### Standalone Usage (Without Laravel)

```php
use TeamNiftyGmbH\ResellerInterface\ResellerInterface;

$sdk = new ResellerInterface(
    username: 'your-username',
    password: 'your-password',
    resellerId: 12345
);

$response = $sdk->domains()->domainList();
```

## Available Resources

The SDK provides access to all ResellerInterface API endpoints:

### Domain Management
```php
// List all domains
$sdk->domains()->domainList();

// Get domain details
$sdk->domains()->domainDetails($domainId);

// Check domain availability
$sdk->domains()->domainCheck($domainName);

// Create new domain
$sdk->domains()->domainCreate($domain, $handles);

// Transfer domain
$sdk->domains()->domainTransfer($domain, $authCode);
```

### DNS Management
```php
// List DNS records
$sdk->dns()->dnsListRecords($domainId);

// Create DNS record
$sdk->dns()->dnsCreateRecord($zoneId, $record);

// Update DNS zone
$sdk->dns()->dnsUpdateZone($zoneId, $data);

// Enable DNSSEC
$sdk->dns()->dnsEnableDnssec($domainId);
```

### SSL Certificates
```php
// List SSL certificates
$sdk->ssl()->sslList();

// Order SSL certificate
$sdk->ssl()->sslCreate($data);

// Get SSL details
$sdk->ssl()->sslDetails($sslId);
```

### Reseller Management
```php
// Get reseller info
$sdk->resellers()->resellerDetails();

// List sub-resellers
$sdk->resellers()->resellerList();

// Update reseller settings
$sdk->resellers()->resellerUpdate($data);
```

### Other Resources

- **Handles**: `$sdk->handles()`
- **Invoices**: `$sdk->invoices()`
- **TLDs**: `$sdk->tlds()`
- **Emails**: `$sdk->emails()`
- **Webspaces**: `$sdk->webspaces()`
- **Users**: `$sdk->users()`
- **Billing**: `$sdk->billing()`
- **Tickets**: `$sdk->tickets()`
- **And many more...**

## Authentication

The SDK handles authentication automatically. When you make your first API request, it will:

1. Send login request with your credentials
2. Store the session ID from the response
3. Include the session cookie in all subsequent requests
4. Automatically re-authenticate if the session expires

You don't need to manage authentication manually.

### Two-Factor Authentication

If your account uses 2FA, you can provide the codes during initialization:

```php
$sdk = new ResellerInterface(
    username: 'your-username',
    password: 'your-password',
    resellerId: 12345
);

// For manual 2FA authentication
$sdk->withAuthentication(
    username: 'your-username',
    password: 'your-password',
    resellerId: 12345,
    sms: '123456',  // SMS code if using SMS 2FA
    totp: '654321'  // TOTP code if using app-based 2FA
);
```

## Error Handling

The SDK uses Saloon's exception handling:

```php
use Saloon\Exceptions\Request\RequestException;
use Saloon\Exceptions\Request\ServerException;
use Saloon\Exceptions\Request\ClientException;

try {
    $response = $sdk->domains()->domainList();
    $data = $response->json();
} catch (ClientException $e) {
    // 4xx errors (e.g., validation errors, not found)
    $status = $e->getStatus();
    $body = $e->response()->json();
} catch (ServerException $e) {
    // 5xx errors
    $status = $e->getStatus();
} catch (RequestException $e) {
    // Other request errors
    $message = $e->getMessage();
}
```

## Working with Responses

All SDK methods return a `Saloon\Http\Response` object:

```php
$response = $sdk->domains()->domainList();

// Get response data
$json = $response->json();        // Parsed JSON
$body = $response->body();        // Raw body string
$status = $response->status();    // HTTP status code
$headers = $response->headers();  // Response headers

// Check response status
if ($response->successful()) {
    // 2xx response
}

if ($response->failed()) {
    // 4xx or 5xx response
}

// Work with the data
$domains = $response->json()['data'] ?? [];
foreach ($domains as $domain) {
    echo $domain['domainName'] . PHP_EOL;
}
```

## DTOs (Data Transfer Objects)

Some responses are automatically mapped to DTOs for better type safety:

```php
$response = $sdk->domains()->domainDetails($domainId);
$domain = $response->dto(); // Returns TeamNiftyGmbH\ResellerInterface\Dto\Domain

// Access properties with IDE autocompletion
echo $domain->domainName;
echo $domain->domainStatus;
echo $domain->expiryDate;
```

## Advanced Usage

### Custom Request Headers

```php
$request = new \TeamNiftyGmbH\ResellerInterface\Requests\Domains\DomainList();
$request->headers()->add('X-Custom-Header', 'value');

$response = $sdk->send($request);
```

### Pagination

Many list endpoints support pagination:

```php
$response = $sdk->domains()->domainList(
    offset: 0,
    limit: 100,
    sort: ['domainName' => 'asc']
);

$totalCount = $response->json()['data']['totalCount'];
$domains = $response->json()['data']['data'];
```

### Filtering and Searching

```php
$response = $sdk->domains()->domainList(
    search: ['domainName' => 'example'],
    filter: ['domainStatus' => 'ACTIVE'],
    include: ['contacts', 'nameservers']
);
```

## Testing

For testing, you can mock the SDK:

```php
use TeamNiftyGmbH\ResellerInterface\ResellerInterface;
use Saloon\Http\Faking\MockResponse;
use Saloon\Laravel\Facades\Saloon;

// In your test
Saloon::fake([
    ResellerInterface::class => MockResponse::make(
        body: ['data' => ['totalCount' => 5]],
        status: 200
    ),
]);

$sdk = resellerInterface();
$response = $sdk->domains()->domainList();

$this->assertEquals(5, $response->json()['data']['totalCount']);
```

## Requirements

- PHP 8.3 or higher
- Laravel 11.0+ (optional, for Laravel integration)

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## Support

For API documentation, visit the [ResellerInterface API Documentation](https://core.resellerinterface.de/api).

For issues with this SDK, please create an issue on GitHub.