<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\OptionsProduct;
use App\Http\Controllers\Controller;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Product $product)
    {
        return view('Admin.Product.Crud-Options.create', compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'color' => 'required',
            'size' => 'required',
            'quantity' => 'required|integer'
        ]);
        OptionsProduct::create($request->all());
        notify()->success('Created Option Success !!', 'Creatation');
        return redirect()->route('product.show', $request->post('product_id'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OptionsProduct $option, Product $product)
    {
        return view('Admin.Product.Crud-Options.edit', compact('option', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OptionsProduct $option)
    {
        $request->validate([
            'hexa' => 'required',
            'size' => 'required',
            'qty' => 'required|integer'
        ]);
        // dd($request->all());
        $option->update($request->all());
        notify()->success('Updated Option Success !!', 'Updating');
        return redirect()->route('product.show', $request->post('product_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OptionsProduct $option, Request $request)
    {
        $option->delete();
        notify()->success('Deleted Option Success !!', 'Deleting');
        return redirect()->route('product.show', $request->post('product_id'));
    }
}
