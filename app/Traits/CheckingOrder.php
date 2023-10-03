<?php

namespace App\Traits;

use App\Models\CartItem;
use App\Models\UserCart;
use App\Models\UserOrder;
use App\Models\OptionsProduct;
use Illuminate\Support\Facades\Auth;

trait CheckingOrder
{
    public function checking_order()
    {
        $order = UserOrder::where('user_id', Auth::id())->where('payment_status', '!=', 'Paid')->first();
        if ($order) {
            if ($this->ChangeAmountOfOrder($order)) {
                $order->delete();
                return redirect()->route('show.cart');
            } elseif (!Auth::check()) {
                return redirect()->route('get_login');
            }
            $response = $this->process($order);
            return redirect($response['Data']['InvoiceURL']);
        }
        return false;
    }
    public function ChangeAmountOfOrder($order)
    {
        $is_error = 0;
        foreach ($order->Products as $item) {
            $qty_order = $item->pivot->quantity;
            $option = OptionsProduct::where('id', $item->pivot->option_id)->first();
            if ($option) {
                if ($qty_order > $option->quantity) {
                    notify()->error("$item->name ( $option->color ) Is Sold , $option->quantity Left !!");
                    $is_error = 1;
                    $data = UserCart::where('user_id', Auth::id())->first()->Products()
                        ->where('products.id', $item->id)
                        ->where('option_id', $item->pivot->option_id)->first();
                    CartItem::where('id', $data->pivot->id)->update(['quantity' => $option->quantity]);
                }
            } else {
                notify()->error("$item->name ( $option->color ) Is Sold !!");
                $is_error = 1;
                $data = UserCart::where('user_id', Auth::id())->first()->Products()
                    ->where('products.id', $item->id)
                    ->where('option_id', $item->pivot->option_id)->first();
                CartItem::where('id', $data->pivot->id)->update(['quantity' => $option->quantity]);
            }
        }
        if ($is_error == 1) {
            return true;
        } else {
            return false;
        }
    }
}
