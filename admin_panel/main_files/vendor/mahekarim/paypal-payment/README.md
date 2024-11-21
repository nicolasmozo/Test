# PayPal Payment Integration

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mahekarim/paypal-payment.svg?style=flat-square)](https://packagist.org/packages/mahekarim/paypal-payment)
[![Total Downloads](https://img.shields.io/packagist/dt/mahekarim/paypal-payment.svg?style=flat-square)](https://packagist.org/packages/mahekarim/paypal-payment)
[![License](https://img.shields.io/github/license/yourusername/paypal-payment.svg?style=flat-square)](https://github.com/yourusername/paypal-payment/blob/main/LICENSE)

A lightweight PHP package to integrate PayPal payment services into your application. This package provides a simple way to create and execute payments using PayPal’s API in both sandbox and live modes.

## Features

- Create and execute PayPal payments with minimal setup.
- Easily configurable to switch between sandbox and live modes.
- Integrates seamlessly with Laravel or any other PHP framework.

## Installation

Install the package via Composer:

```bash
composer require mahekarim/paypal-payment
```

## Configuration
Step 1: Set up environment variables
Add your PayPal API credentials to your .env file:
```
PAYPAL_CLIENT_ID=your-client-id
PAYPAL_SECRET_ID=your-secret-id
PAYPAL_ACCOUNT_MODE=sandbox
```

#Step 2: Publish the configuration (Optional for Laravel)
If you're using Laravel, publish the config file:


```
php artisan vendor:publish --provider="Mahekarim\PaypalPayment\PayPalServiceProvider"
```
Configuration
Step 1: Set up environment variables
Add your PayPal API credentials to your .env file:

env
Copy code
```
PAYPAL_CLIENT_ID=your-client-id
PAYPAL_SECRET_ID=your-secret-id
PAYPAL_ACCOUNT_MODE=sandbox # Change to 'live' for production
```
Step 2: Publish the configuration (Optional for Laravel)
If you're using Laravel, publish the config file:

```
php artisan vendor:publish --provider="MaheKarim\PaypalPayment\PayPalServiceProvider"
```
This will create a configuration file ``config/paypal.php`` where you can specify your PayPal settings.

Usage
Step 1: Create a Payment
To create a payment, use the PayPalService class:
```
<?php

use MaheKarim\PaypalPayment\PayPalService;

$paypalService = new PayPalService(env('PAYPAL_CLIENT_ID'), env('PAYPAL_SECRET_ID'), env('PAYPAL_ACCOUNT_MODE'));
$paymentResponse = $paypalService->createPayment($amount, $currency, $returnUrl, $cancelUrl);

if (isset($paymentResponse['approval_link'])) {
    // Redirect user to the PayPal approval link
    return redirect($paymentResponse['approval_link']);
} else {
    // Handle error response
    return response()->json(['error' => $paymentResponse['message']]);
}
```
Step 2: Execute a Payment
After the user approves the payment, execute the payment using the executePayment method:

```

$paymentId = $request->input('paymentId');
$payerId = $request->input('PayerID');

$result = $paypalService->executePayment($paymentId, $payerId);

if ($result && $result['state'] === 'approved') {
    // Payment was successful
    // Process the order here
} else {
    // Handle failed payment
    return response()->json(['error' => $result['message']]);
}
```
Example Usage in a Laravel Controller
Here’s an example of how you might use the package in a Laravel controller:

```
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MaheKarim\PaypalPayment\PayPalService;

class PaypalController extends Controller
{
    protected $paypalService;

    public function __construct()
    {
        $this->paypalService = new PayPalService(
            config('paypal.client_id'),
            config('paypal.secret_id'),
            config('paypal.mode')
        );
    }

    public function createPayment(Request $request)
    {
        $paymentResponse = $this->paypalService->createPayment(49.00, 'USD', route('paypal.return'), route('paypal.cancel'));

        if (isset($paymentResponse['approval_link'])) {
            return redirect($paymentResponse['approval_link']);
        } else {
            return redirect()->back()->withErrors(['error' => 'Unable to create PayPal payment.']);
        }
    }

    public function executePayment(Request $request)
    {
        $result = $this->paypalService->executePayment($request->input('paymentId'), $request->input('PayerID'));

        if ($result && $result['state'] === 'approved') {
            // Handle successful payment
        } else {
            // Handle failed payment
        }
    }
}

```
## Testing

For local testing, make sure to set ``PAYPAL_ACCOUNT_MODE=sandbox`` in your ``.env`` file and use PayPal sandbox test credentials. You can create test accounts and API credentials on the PayPal Developer Portal.

### Changelog
Please see the CHANGELOG for more information on what has changed recently.

### Contributing
Feel free to open an issue or submit a pull request for improvements and bug fixes.

### Fork the repository.
* Create a new branch ``(git checkout -b feature/YourFeatureName)``
* Commit your changes ``(git commit -am 'Add new feature')``
* Push to the branch ``(git push origin feature/YourFeatureName)``
* Create a new Pull Request.

#### License
This package is open-sourced software licensed under the MIT license.

## Credits
* <a href="https://github.com/MaheKarim">Mahe Karim aka [mahekarim@gmail.com]</a>


### Notes:
- Update any URLs, such as in `LICENSE` and `CHANGELOG`, to reflect their actual paths if they differ.
- After finalizing the `README.md` file, commit it to your repository’s root directory. 

Let me know if you’d like to further customize any specific sections!


