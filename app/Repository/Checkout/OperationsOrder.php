<?php

namespace App\Repository\Checkout;

use App\Events\CreateAccount;
use App\Facade\Cart;
use App\Http\Requests\billingAddress;
use App\Models\Address;
use App\Models\OptionsProduct;
use App\Models\OrderItem;
use App\Models\UserCart;
use App\Models\UserOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OperationsOrder implements IOrder
{

    public function create($request)
    {
        $cart = UserCart::first();
        DB::beginTransaction();
        try {
            $order = UserOrder::create([
                'user_id' => Auth::id(),
                'status_order' => 'pending',
                'coupone_id' => $cart->coupone_id ?? null,
                'coupone' => ($cart->coupone_id) ? json_encode($cart->Coupone) : null,
                'shiping_price' => 0,
                'total_price' => $this->CheckCouponeInCart($cart)
            ]);
            foreach (Cart::ShowCart() as $value) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $value->product_id,
                    'product_name' => $value->name,
                    'option_id' => $value->option_id,
                    'option' => json_encode(OptionsProduct::where('id', $value->option_id)->first()),
                    'quantity' => $value->quantity,
                    'price' => $value->price,
                ]);
            }
            if ($request->post('different_address')) {
                Address::create([
                    'first_name' => $request['address']['shiping']['first_name'],
                    'last_name' => $request['address']['shiping']['last_name'],
                    'order_id' => $order->id,
                    'type' => 'shiping',
                    'address_name' => $request['address']['billing']['address_name'],
                    'city' => $request['address']['shiping']['city'],
                    'state' => $request['address']['shiping']['state'],
                ]);
            }
            Address::create([
                'first_name' => $request['address']['billing']['first_name'],
                'last_name' => $request['address']['billing']['last_name'],
                'order_id' => $order->id,
                'type' => 'billing',
                'address_name' => $request['address']['billing']['address_name'],
                'city' => $request['address']['billing']['city'],
                'state' => $request['address']['billing']['state'],
                'phone_number' => $request['address']['billing']['phone_number'],
                'email' => $request['address']['billing']['email'],
            ]);
            DB::commit();
            return $order;
        } catch (\Throwable $th) {
            DB::rollBack();
            dd($th->getMessage());
        }
    }
    public function CheckCouponeInCart($cart)
    {
        $total = Cart::total();
        if ($cart->coupone_id) {
            return $total - (($cart->Coupone->discount / 100) * $total);
        } else {
            return Cart::total();
        }
    }
}
