<?php

namespace App\Http\Controllers\Checkout;

use App\Models\UserCart;
use App\Traits\CheckingOrder;
use App\Traits\PaymentProcess;
use App\Http\Requests\FormAddress;
use App\Repository\Cart\ModelCart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repository\Checkout\OperationsOrder;

class CheckoutController extends Controller
{
    use PaymentProcess, CheckingOrder;
    public function show(ModelCart $modelCart)
    {
        $total = $modelCart->total();
        $cart = UserCart::first();
        ///check if user_cart is founded or not/////////////////
        if (!$cart->first()) {
            notify()->error('Not Found Items', "Error");
            return redirect()->route('get_shop');
        }
        if ($this->checking_order()) {
            return $this->checking_order();
        }
        // $countries = Countries::getNames();
        return view('Site.Checkout.checkout', compact('cart', 'total'));
    }
    public function create(FormAddress $request)
    {
        $o = new OperationsOrder();
        UserCart::first()->update(['user_id' => Auth::id()]);
        $order = $o->create($request);
        $response = $this->process($order);
        return redirect($response['Data']['InvoiceURL']);
        // return redirect()->route('payment.show', $order);
    }
}
