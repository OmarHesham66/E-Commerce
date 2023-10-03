<?php

namespace App\Http\Livewire;

use App\Repository\Cart\ModelCart;
use App\Traits\PreviousOrder;
use Livewire\Component;
use App\Models\UserCart;

class QtyInCartPage extends Component
{
    use PreviousOrder;
    // public $cart;
    // public function mount($cart)
    // {
    //     $this->cart = $cart;
    // }
    public function render()
    {
        $cart = UserCart::first();
        if ($cart) {
            $modelCart = new ModelCart();
            $total = $modelCart->total();
            $options = $cart->CartItems()->with('Options')->get();
            return view('livewire.CartPage.qty-in-cart-page', compact('cart', 'options', 'total'));
        }
        return view('livewire.CartPage.qty-in-cart-page', compact('cart'));
    }
    public function updateUp($id)
    {
        $this->check();
        $c = new ModelCart();
        $c->updateUp(1, $id);
        $this->emit('incermentNumber');
    }
    public function updateDown($id)
    {
        $this->check();
        $c = new ModelCart();
        $c->updateDown(1, $id);
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
        $c = new ModelCart();
        $c->empty();
        $this->emit('incermentNumber');
    }
}
