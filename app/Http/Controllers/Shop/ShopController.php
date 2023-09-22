<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopController extends Controller
{
    public function get_shop(Request $request)
    {
        $products = Product::filter([$request->query()])->paginate(PAGINATE);
        // dd($products);
        return view('Site.Shop.shop', compact('products'));
    }
}
