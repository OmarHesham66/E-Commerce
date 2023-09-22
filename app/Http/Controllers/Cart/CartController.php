<?php

namespace App\Http\Controllers\Cart;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\UserCart;
use App\Repository\Cart\ModelCart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function show()
    {
        $cart = UserCart::first();
        return view('Site.cart.cart', compact('cart'));
    }
    public function update(Request $request, CartItem $cartItem)
    {
        $request->validate([
            'quantity' => 'integer'
        ]);
    }
    public function check_coupone()
    {
    }
}
