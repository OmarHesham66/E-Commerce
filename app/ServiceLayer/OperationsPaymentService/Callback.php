<?php

namespace App\ServiceLayer\OperationsPaymentService;

use App\Facade\Cart;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\UserOrder;
use App\Events\CreatedOrder;
use App\Traits\UpdateQuantityProduct;

class Callback
{
    use UpdateQuantityProduct;

    public function create($response)
    {
        $invoice = Invoice::where('invoice_id', $response['Data']['InvoiceId'])->first();
        if ($invoice) {
            $order = UserOrder::where('order_number', $invoice['order_number']);
            $order->update(['payment_status' => 'Paid']);
            Cart::empty($invoice->user_id);
            foreach ($order->first()->OrderItems as $item) {
                $this->down($item->option_id, $item->quantity);
            }
            Invoice::where('user_id', $invoice->user_id)->delete();
            Payment::create([
                'order_id' => $order->first()->id,
                'invoice_id' => $response['Data']['InvoiceId'],
                'payment_method' => $response['Data']['InvoiceTransactions'][0]['PaymentGateway'],
                'currency' => $response['Data']['InvoiceTransactions'][0]['PaidCurrency'],
                'total_price' => $order->first()->total_price,
                'transction_id' => $response['Data']['InvoiceTransactions'][0]['TransactionId'],
                'transction_data' => json_encode($response['Data']['InvoiceTransactions'][0]),
            ]);
            event(new CreatedOrder($order));
            notify()->success('Payment Successful', 'Payment');
            return redirect()->route('get_shop');
        } else {
            // dd($response);
            return abort(404, 'Invalid Request !!');
        }
    }
}
