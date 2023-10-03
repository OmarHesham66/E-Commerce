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
        return view('Site.cart.cart');
    }
    public function check_coupone()
    {
    }
}
