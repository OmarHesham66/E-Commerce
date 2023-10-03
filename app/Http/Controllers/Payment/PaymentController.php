<?php

namespace App\Http\Controllers\Payment;

use App\Facade\Cart;
use App\Models\Invoice;
use App\Models\UserOrder;
use App\Traits\UpdateQuantityProduct;
use Illuminate\Http\Request;
use App\Services\MyFatorahService;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    use UpdateQuantityProduct;
    public function callback(Request $request)
    {
        $response = (new MyFatorahService)->GetPaymentStatus([
            'Key' => $request->query('paymentId'),
            'KeyType' => 'PaymentId'
        ]);
        // dd($response['Data']['InvoiceId']);
        $invoice = Invoice::where('invoice_id', $response['Data']['InvoiceId'])->first();
        if ($invoice && $invoice->invoice_id == $response['Data']['InvoiceId']) {
            $order = UserOrder::where('order_number', $invoice['order_number']);

            $order->update(['payment_status' => 'Paid']);
            Cart::empty($invoice->user_id);
            foreach ($order->first()->OrderItems as $item) {
                $this->down($item->option_id, $item->quantity);
            }
            Invoice::where('user_id', $invoice->user_id)->delete();
            notify()->success('Payment Successful', 'Payment');
            return redirect()->route('get_shop');
        }
    }
    public function failed()
    {
        return 'error';
    }
}
