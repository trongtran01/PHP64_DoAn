<?php

namespace App\Helpers;

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Core\ProductionEnvironment;

class PayPalClient
{
    public static function client()
    {
        $clientId = config('paypal.client_id');
        $clientSecret = config('paypal.client_secret');
        $mode = config('paypal.mode');

        if ($mode === 'live') {
            $environment = new ProductionEnvironment($clientId, $clientSecret);
        } else {
            $environment = new SandboxEnvironment($clientId, $clientSecret);
        }

        return new PayPalHttpClient($environment);
    }
}