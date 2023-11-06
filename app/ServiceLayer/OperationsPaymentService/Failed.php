<?php

namespace App\ServiceLayer\OperationsPaymentService;

class Failed
{
    public function error()
    {
        notify()->error('Payment Failed', 'Payment');
        return redirect()->route('get_shop');
    }
}
