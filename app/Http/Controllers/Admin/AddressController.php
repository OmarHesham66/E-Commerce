<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\UserOrder;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserOrder $order, Address $address)
    {
        return view('Admin.Orders.Crud-Address.edit', compact('order', 'address'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Address $address)
    {
        $request->validate([
            'type' => 'required',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'address_name' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone_number' => 'required|integer',
            'email' => 'required|email',
        ]);
        $address->update($request->all());
        notify()->success('Updated Address Success !!', 'Updating');
        return redirect()->route('order.address.show', $request->post('order_id'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Address $address)
    {
        $address->delete();
        notify()->success('Deleted Address Success !!', 'Deleting');
        return redirect()->route('order.address.show', $request->post('order_id'));
    }
}
