<?php

namespace App\Http\Controllers\Product;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\OptionsProduct;

class ProductController extends Controller
{
    public function get_details_product($id)
    {
        $product = Product::with('Category.SuperCategory')->where('id', '=', $id)->first();
        $related_products = Product::where('category_id', $product->Category->id)->inRandomOrder()->limit(4)->get();
        // return $product;
        return view('Site.product-details', compact('product', 'related_products'));
    }
    public function get_options(Request $req)
    {
        return dd($req);
    }
}
