<?php

namespace App\Traits;

use App\Models\UserCart;
use App\Models\OptionsProduct;

trait UpdateQuantityProduct
{
    public function down($option_id, $qty)
    {
        $option = OptionsProduct::where('id', $option_id)->first();
        $new_qty = $option->quantity - $qty;
        if ($new_qty == 0) {
            $option->delete();
        }
        $option->update(['quantity' => $new_qty]);
    }
    public function up($option_id, $qty)
    {
        $option = OptionsProduct::where('id', $option_id)->first();
        $new_qty = $option->quantity + $qty;
        $option->update(['quantity' => $new_qty]);
    }
    // public function lol($qty, $product_id)
    // {
    //     $cart = UserCart::with(['CartItems' => function ($q) use ($product_id) {
    //         $q->where('product_id', $product_id);
    //     }])->where('cookie_id', $this->get_cookie())->first();
    //     $options_ids = [];
    //     $qtys = [];
    //     for ($i = count($cart->CartItems->quantity) - 1; $i > 0; $i--) {
    //         if ($qty <= $cart->CartItems->quantity[$i]) {
    //             array_push($qtys, (int)$qty);
    //             array_push($options_ids, $cart->CartItems->options_id[$i]);
    //             return [$options_ids, $qtys];
    //         }
    //         $qty = $qty - $cart->CartItems->quantity[$i];
    //         array_push($qtys, $cart->CartItems->quantity[$i]);
    //         array_push($options_ids, $cart->CartItems->options_id[$i]);
    //     }
    //     return [$options_ids, $qtys];
    // }
}
