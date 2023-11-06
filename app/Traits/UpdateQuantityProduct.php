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
}
