<?php

namespace App\Http\Controllers\Shop;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SuperCategory;

class ShopController extends Controller
{
    public function get_shop()
    {
        $products = Product::paginate(PAGINATE);
        return view('Site.shop', compact('products'));
    }

    public function get_shop_by_category($category_id)
    {
        $products = Product::where('category_id', $category_id)->paginate(12);
        return view('Site.shop', compact('products'));
    }

    public function get_shop_by_discount()
    {
        return view('Site.shop');
    }

    public function get_shop_by_summer()
    {
        return view('Site.shop');
    }
    public function get_fashion()
    {
        $products = Product::wherehas('Category', function ($q) {
            $q->with('SuperCategory', function ($q) {
                $q->WhereIn('name', ['Men Fashion', 'Women Fashion']);
            });
        })->paginate(PAGINATE);
        return view('Site.shop', compact('products'));
    }
}
