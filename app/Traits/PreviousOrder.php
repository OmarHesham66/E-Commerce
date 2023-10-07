<?php

namespace App\Traits;

use App\Models\CartItem;
use App\Models\OrderItem;
use App\Models\UserCart;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;

trait PreviousOrder
{
    public function check()
    {
        $previous_order = UserOrder::where('user_id', Auth::id())->where('payment_status', '!=', "Paid")->first();
        if ($previous_order) {
            foreach (UserCart::WithoutglobalScope('cookie')->where('user_id', Auth::id())->first()->CartItems as $item) {
                OrderItem::updateOrCreate([
                    'order_id' => $previous_order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->Product->name,
                    'price' => $item->Product->price,
                    'option' => json_encode($item->Option),
                    'option_id' => $item->option_id
                ], [
                    'quantity' => $item->quantity
                ]);
            }
        }
    }
}
