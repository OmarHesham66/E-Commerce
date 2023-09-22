<?php

namespace App\Http\Controllers\CheckOut;

use App\Models\UserCart;
use App\Repository\Cart\ModelCart;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    public function show(ModelCart $modelCart)
    {
        $total = $modelCart->total();
        $cart = UserCart::first();
        return view('Site.Checkout.checkout', compact('cart', 'total'));
    }
}
