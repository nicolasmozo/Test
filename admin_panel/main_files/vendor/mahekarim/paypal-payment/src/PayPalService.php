<?php

namespace MaheKarim\PaypalPayment;
class PayPalService
{
    protected $clientId;
    protected $clientSecret;
    protected $apiUrl;

    public function __construct($clientId, $clientSecret, $accountMode)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;
        $this->apiUrl = $accountMode === 'live' 
            ? 'https://api.paypal.com' 
            : 'https://api.sandbox.paypal.com';
    }

    public function createPayment($amount, $currency, $returnUrl, $cancelUrl)
    {
        $accessToken = $this->getAccessToken();
    
        // Prepare payment data
        $paymentData = [
            'intent' => 'sale',
            'payer' => ['payment_method' => 'paypal'],
            'transactions' => [[
                'amount' => [
                    'total' => $amount,
                    'currency' => $currency
                ],
                'description' => 'Payment description'
            ]],
            'redirect_urls' => [
                'return_url' => $returnUrl,
                'cancel_url' => $cancelUrl
            ]
        ];
    
        // Make the API request
        $response = $this->makeRequest('/v1/payments/payment', 'POST', $paymentData, $accessToken);
    
        // Log the response for debugging
        \Log::info('PayPal API Response', ['response' => $response]);
    
        // Check response and return appropriate data
        if (isset($response['id'])) {
            // Find the approval link
            $approvalLink = collect($response['links'])->firstWhere('rel', 'approval_url')['href'] ?? null;
    
            return [
                'success' => true,
                'approval_link' => $approvalLink, // Return the approval link
                'payment_id' => $response['id'], // Return the payment ID for later use
            ];
        }
    
        // Handle error cases
        return [
            'success' => false,
            'message' => $response['message'] ?? 'An error occurred while creating the payment.',
            'error' => $response, // Optional: include the full error response for debugging
        ];
    }
    

    public function executePayment($paymentId, $payerId)
    {
        $accessToken = $this->getAccessToken();

        $executionData = [
            'payer_id' => $payerId
        ];

        $response = $this->makeRequest("/v1/payments/payment/{$paymentId}/execute", 'POST', $executionData, $accessToken);

        return $response;
    }

    protected function getAccessToken()
    {
        $url = $this->apiUrl . '/v1/oauth2/token';
        $credentials = base64_encode("{$this->clientId}:{$this->clientSecret}");

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Basic {$credentials}",
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials');

        $result = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($result, true);

        return $data['access_token'] ?? null;
    }

    protected function makeRequest($endpoint, $method, $data, $accessToken)
    {
        $url = $this->apiUrl . $endpoint;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer {$accessToken}",
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $result = curl_exec($ch);
        curl_close($ch);

        return json_decode($result, true);
    }

}
