<?php

namespace App\Http\Controllers\User;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OptionsProduct;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    public function get_details_product($id)
    {
        // Gate::authorize()
        $product = Product::with('Category.SuperCategory')->where('id', '=', $id)->first();
        $related_products = Product::where('category_id', $product->Category->id)->inRandomOrder()->limit(4)->get();
        // return $product;
        return view('Site.Product.product-details', compact('product', 'related_products'));
    }
    public function get_options(Request $req)
    {
        return dd($req);
    }
}
