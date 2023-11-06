<?php

namespace App\Traits;

use App\Models\Invoice;
use App\Services\MyFatorahService;
use Illuminate\Support\Facades\Auth;

trait CreateInvoice
{
    public function process($order)
    {
        $data = [
            'CustomerName' => $order->User->name,
            'CustomerEmail' => $order->billing->email,
            'InvoiceValue' => $order->total_price,
            'NotificationOption' => "LNK",
            'PaymentMethodId' => 2,
            'DisplayCurrencyIso' => 'EGP',
            'Product_Data' => $order->Products,
            'CallBackUrl' => config('services.my_fatorah.callback'),
            'ErrorUrl' => config('services.my_fatorah.error'),
        ];
        $my_fatorah = new MyFatorahService();
        $response = $my_fatorah->sendPayment($data);
        Invoice::create([
            'user_id' => Auth::id(),
            'invoice_id' => $response['Data']['InvoiceId'],
            'order_number' => $order->order_number
        ]);
        return $response;
    }
}
