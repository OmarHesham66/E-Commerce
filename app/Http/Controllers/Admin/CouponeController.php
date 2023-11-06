<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupone;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class CouponeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coupones = Coupone::get();
        return view('Admin.Coupone.coupone', compact('coupones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Admin.Coupone.Crud-Coupone.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|integer',
            'discount' => 'required|max:80|min:1|numeric',
        ]);
        Coupone::create($request->all());
        Artisan::call('schedule:run');
        notify()->success('Created Coupone Success !!', 'Creatation');
        return redirect()->route('coupone.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Coupone $coupone)
    {
        $coupone->delete();
        notify()->success('Deleted Coupone Success !!', 'Deleting');
        return redirect()->route('coupone.index');
    }
}
