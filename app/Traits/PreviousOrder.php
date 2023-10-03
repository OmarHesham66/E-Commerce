<?php

namespace App\Traits;

use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;

trait PreviousOrder
{
    public function check()
    {
        $previous_order = UserOrder::where('user_id', Auth::id())->where('payment_status', '!=', "Paid")->first();
        if ($previous_order) {
            $previous_order->delete();
        }
    }
}
