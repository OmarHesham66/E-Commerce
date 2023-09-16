<?php

namespace App\Http\Controllers\User;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use App\Models\SuperCategory;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function get_home_site()
    {
        $popular_products = Product::inRandomOrder()->limit(8)->get();
        $new_added_products = Product::orderByDesc('id')->limit(8)->get();
        $categories = Category::inRandomOrder()->limit(10)->get();
        $brands = Brand::get();
        // $supers = SuperCategory::with('Category')->get();
        return view('site-home', compact('popular_products', 'new_added_products', 'categories', 'brands'));
    }
}
