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
        $search = [
            'search' => request()->post('text') ?? null
        ];
        $filter = count($request->query()) > 0 ? $request->query() : $search;
        $products = Product::filter($filter)->paginate(PAGINATE);
        return view('Site.Shop.shop', compact('products'));
    }
}
