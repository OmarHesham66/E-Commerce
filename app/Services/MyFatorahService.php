<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\HttpCache\HttpCache;

class MyFatorahService
{
    private $base_api;
    public function __construct()
    {
        $this->base_api = config('services.my_fatorah.base_api');
    }

    public function sendPayment($data)
    {
        $response = Http::baseUrl($this->base_api)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.my_fatorah.token'),
            ])
            ->post('v2/SendPayment', $data);
        return $response->json();
    }
    public function GetPaymentStatus($data)
    {
        $response = Http::baseUrl($this->base_api)
            ->withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . config('services.my_fatorah.token'),
            ])
            ->post('v2/GetPaymentStatus', $data);
        return $response->json();
    }
}
