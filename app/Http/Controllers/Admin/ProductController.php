<?php

namespace App\Http\Controllers\Admin;

use App\Models\OptionsProduct;
use App\Models\Product;
use App\Models\Category;
use App\Traits\Save_photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormProduct;
use App\Services\ColorService;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use Save_photos;
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }
    public function index()
    {
        $products = Product::with('Category', 'Options')->get();
        // $options = $products->Options;
        return view('Admin.Product.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('Admin.Product.Crud-Product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FormProduct $request)
    {
        // dd($request->all());
        if ($this->validate_option($request)) {
            return $this->validate_option($request);
        }
        try {
            DB::beginTransaction();
            $colors = (new ColorService())->get_name($request->post('option'));
            $options = array_chunk($request->post('option'), 3);
            $product = Product::create($this->get_data($request));
            foreach ($options as $key => $option) {
                OptionsProduct::create([
                    'hexa' => $option[0],
                    'color' => $colors[$key],
                    'quantity' => $option[1],
                    'size' => $option[2],
                    'product_id' => $product->id
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
        notify()->success('Created Product Success !!', 'Creatation');
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = $product->load('Options');
        return view('Admin.Product.Crud-Product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();
        return view('Admin.Product.Crud-Product.edit', compact('categories', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(FormProduct $request, Product $product)
    {
        if ($request->has('photo')) {
            $data = $request->except('photo');
            $new_photo = $request->file('photo');
            $old_photo = $product->photo;
            $data['photo'] = $this->save_photo('product_photos', $new_photo);
            $product->update($data);
            Storage::disk('Images')->delete($old_photo);
            notify()->success('Updated Product Success !!', 'Updating');
            return redirect()->route('product.index');
        }
        $product->update($request->all());
        notify()->success('Updated Product Success !!', 'Updating');
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $old_photo = $product->photo;
        $product->delete();
        Storage::disk("Images")->delete($old_photo);
        notify()->success('Deleted Product Success !!', 'Deleting');
        return redirect()->route('product.index');
    }

    public function validate_option(Request $request)
    {
        if (!$request->has('option')) {
            notify()->error('Options Of Product Is Required', 'ERROR');
            return redirect()->back()->withInput();
        } elseif (in_array(null, $request->post('option'))) {
            notify()->error('Options Of Product Is Incorrect', 'ERROR');
            return redirect()->back()->withInput();
        }
    }
    public function get_data(Request $request)
    {
        $data = $request->except('photo');
        $photo = $request->file('photo');
        $data['photo'] = $this->save_photo('product_photos', $photo);
        $sum = 0;
        for ($i = 1; $i < count($request->post('option')); $i = $i + 3) {
            $sum = $sum + $request->post('option')[$i];
        }
        $data['quantity'] = $sum;
        return $data;
    }
}
