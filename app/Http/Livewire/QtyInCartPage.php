<?php

namespace App\Http\Livewire;

use App\Facade\Cart;
use App\Repository\Cart\ModelCart;
use App\Traits\PreviousOrder;
use Livewire\Component;
use App\Models\UserCart;

class QtyInCartPage extends Component
{
    use PreviousOrder;
    public function render()
    {
        $cart = UserCart::first();
        if ($cart) {
            $modelCart = new ModelCart();
            $total = $modelCart->total();
            $options = $cart->CartItems()->with('Option')->get();
            return view('livewire.User.CartPage.qty-in-cart-page', compact('cart', 'options', 'total'));
        }
        return view('livewire.CartPage.qty-in-cart-page', compact('cart'));
    }
    public function updateUp($id)
    {
        $this->check();
        Cart::updateUp(1, $id);
        $this->emit('incermentNumber');
    }
    public function updateDown($id)
    {
        $this->check();
        Cart::updateDown(1, $id);
        $this->emit('incermentNumber');
    }
    public function delete($id)
    {
        $this->check();
        $c = new ModelCart();
        if (UserCart::first()->CartItems->count() == 1) {
            $c->empty();
        } else {
            $c->delete($id);
        }
        $this->emit('incermentNumber');
    }
    public function empty()
    {
        $this->check();
        Cart::empty();
        $this->emit('incermentNumber');
    }
}
