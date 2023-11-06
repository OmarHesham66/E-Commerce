<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Mockery\Generator\StringManipulation\Pass\Pass;

class ShopController extends Controller
{
    public function get_shop(Request $request)
    {
        $filter = (count($request->query()) ? $request->query() : ($request->post('text') ?? []));
        $products = Product::filter($filter)->paginate(PAGINATE);
        return view('Site.Shop.shop', compact('products'));
    }
}
