<?php

namespace App\Repository\Cart;

use App\Models\CartItem;
use App\Models\UserCart;
use App\Traits\Get_Cookies;
use App\Traits\UpdateQuantity;
use App\Traits\UpdateQuantityProduct;
use Illuminate\Support\Facades\Auth;


class ModelCart
{
    use Get_Cookies, UpdateQuantityProduct;
    public function add($option_id, $quantity, $product_id)
    {
        $item =  UserCart::first();
        if (!$item) {
            $cart = UserCart::create([
                'cookie_id' => $this->get_cookie()
            ]);
            CartItem::create([
                'options_id' => $option_id,
                'product_id' => $product_id,
                'users_cart_id' => $cart->id,
                'quantity' => $quantity,
            ]);
            $this->down($option_id, $quantity);
        } elseif (!$cart_items = $item->CartItems()->where('product_id', $product_id)->where('options_id', $option_id)->first()) {
            CartItem::create([
                'options_id' => $option_id,
                'product_id' => $product_id,
                'users_cart_id' => $item->id,
                'quantity' => $quantity,
            ]);
            $this->down($option_id, $quantity);
        } else {
            $cart_items->increment('quantity', $quantity);
            $this->down($option_id, $quantity);
        }
    }
    public function update($quantity, $id)
    {
        $cart_item = CartItem::where('id', $id)->first();
        if ($cart_item->quantity > $quantity) {
            $cart_item->update(['quantity' => $quantity]);
            $this->up($cart_item->options_id, $quantity);
        } else {
            $cart_item->update(['quantity' => $quantity]);
            $this->down($cart_item->options_id, $quantity);
        }
    }
    public function delete($id)
    {
        CartItem::where('id', $id)->delete();
    }
    public function empty()
    {
        UserCart::truncate();
    }
    public function ShowCart()
    {
        return UserCart::select('user_id', 'cookie_id', 'product_id', 'cart_items.quantity', 'name', 'price')
            ->join('cart_items', 'cart_items.users_cart_id', '=', 'users_cart.id')
            ->join('products', 'products.id', '=', 'cart_items.product_id')
            ->get();
    }

    public function total()
    {
        return UserCart::select('cart_items.quantity', 'price')
            ->join('cart_items', 'cart_items.users_cart_id', '=', 'users_cart.id')
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
