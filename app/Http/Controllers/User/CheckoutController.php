<?php

namespace App\Http\Controllers\User;

use App\Models\Coupone;
use App\Models\UserCart;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use App\Traits\CheckingOrder;
use App\Traits\CreateInvoice;
use App\Http\Requests\FormAddress;
use App\Repository\Cart\ModelCart;
use App\Http\Controllers\Controller;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Repository\Checkout\OperationsOrder;

class CheckoutController extends Controller
{
    use CreateInvoice, CheckingOrder;
    public function show(ModelCart $modelCart)
    {
        $cart = UserCart::first();
        $total = $modelCart->total();
        $total = ($cart->coupone_id) ? ($total - (($cart->Coupone->discount / 100) * $total)) : $total;
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
        UserCart::first()->update(['user_id' => Auth::id()]);
        $operation = new OperationsOrder();
        $order = $operation->create($request);
        $response = $this->process($order);
        return redirect($response['Data']['InvoiceURL']);
        // return redirect()->route('payment.show', $order);
    }
    public function check_coupone(Request $request)
    {
        $request->validate([
            'coupone' => 'integer'
        ]);
        $coupone = Coupone::where('code', $request->post('coupone'))->first();
        $cart = UserCart::first();
        if (!$coupone) {
            notify()->error('Expired Coupone !!', 'Coupone');
            return redirect()->back();
        } elseif ($cart->coupone_id == $coupone->id) {
            notify()->error('Cannot Apply Coupone Again !!', 'Coupone');
            return redirect()->back();
        }
        UserCart::first()->update(['coupone_id' => $coupone->id]);
        notify()->success('Applied Coupone !!', 'Coupone');
        return redirect()->route('checkout.show');
    }
}
