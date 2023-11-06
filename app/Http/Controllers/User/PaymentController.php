<?php

namespace App\Http\Controllers\User;

use App\Facade\Cart;
use App\Models\Invoice;
use App\Models\UserOrder;
use App\Events\CreatedOrder;
use App\ServiceLayer\OperationsPaymentService\Failed;
use Illuminate\Http\Request;
use App\Services\MyFatorahService;
use App\Http\Controllers\Controller;
use App\Traits\UpdateQuantityProduct;
use App\ServiceLayer\OperationsPaymentService\Callback;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $response = (new MyFatorahService)->GetPaymentStatus([
            'Key' => $request->query('paymentId'),
            'KeyType' => 'PaymentId'
        ]);
        // dd($response);
        return (new Callback)->create($response);
    }
    public function failed()
    {
        return (new Failed)->error();
    }
}
