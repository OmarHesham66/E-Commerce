<?php

namespace App\Repository\Cart;

use App\Models\CartItem;
use App\Models\OptionsProduct;
use App\Models\UserCart;
use App\Traits\Get_Cookies;
use App\Traits\UpdateQuantity;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\UpdateQuantityProduct;


class ModelCart
{
    use Get_Cookies, UpdateQuantityProduct;
    public function add($option_id, $quantity, $product_id)
    {
        $item =  UserCart::first();
        if (!$item) {
            DB::beginTransaction();
            try {
                if (Auth::check()) {
                    $cart = UserCart::create([
                        'cookie_id' => $this->get_cookie(),
                        'user_id' => Auth::id()
                    ]);
                } else {
                    $cart = UserCart::create([
                        'cookie_id' => $this->get_cookie(),
                    ]);
                }
                CartItem::create([
                    'option_id' => $option_id,
                    'product_id' => $product_id,
                    'cart_id' => $cart->id,
                    'quantity' => $quantity,
                ]);
                // $this->down($option_id, $quantity);
                DB::commit();
            } catch (\Throwable $th) {
                DB::rollBack();
            }
        } elseif (!$cart_items = $item->CartItems()->where('product_id', $product_id)->where('option_id', $option_id)->first()) {
            CartItem::create([
                'option_id' => $option_id,
                'product_id' => $product_id,
                'cart_id' => $item->id,
                'quantity' => $quantity,
            ]);
        } else {
            $qty_option = OptionsProduct::find($option_id)->quantity;
            // dd($qty_option);
            if ($cart_items->quantity + $quantity > $qty_option) {
                $cart_items->update(['quantity' => $qty_option]);
            } else {
                $cart_items->increment('quantity', $quantity);
            }
        }
    }
    public function updateUp($quantity, $id)
    {
        $cart_item = CartItem::where('id', $id)->first();
        $qty_in_option = $cart_item->Options->quantity;
        if ($cart_item->quantity != $qty_in_option) {
            $cart_item->update(['quantity' => $cart_item->quantity + $quantity]);
        }
    }
    public function updateDown($quantity, $id)
    {
        $cart_item = CartItem::where('id', $id)->first();
        // $qty_in_option = $cart_item->Options->quantity;
        if ($cart_item->quantity > 1) {
            $cart_item->update(['quantity' => $cart_item->quantity - $quantity]);
        }
    }
    public function delete($id)
    {
        CartItem::where('id', $id)->delete();
    }
    public function empty($id = null)
    {
        if ($id != null) {
            UserCart::where('user_id', $id)->delete();
        }
        UserCart::where('cookie_id', $this->get_cookie())->delete();
    }
    public function ShowCart()
    {
        return UserCart::select('user_id', 'cookie_id', 'product_id', 'cart_items.quantity', 'name', 'price', 'option_id')
            ->join('cart_items', 'cart_items.cart_id', '=', 'users_cart.id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->get();
    }

    public function total()
    {
        return UserCart::select('cart_items.quantity', 'price')
            ->join('cart_items', 'cart_items.cart_id', '=', 'users_cart.id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')->get()
            ->sum(function ($item) {
                return $item->price * $item->quantity;
            });
    }
    public function ProductNumber()
    {
        return UserCart::withCount('Products')->first()->products_count;
    }
}
