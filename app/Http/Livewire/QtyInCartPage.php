<?php

namespace App\Http\Livewire;

use App\Models\CartItem;
use App\Models\OptionsProduct;
use App\Repository\Cart\ModelCart;
use Livewire\Component;
use App\Models\UserCart;

class QtyInCartPage extends Component
{
    public $cart;
    public function mount($cart)
    {
        $this->cart = $cart;
    }
    public function render()
    {
        $modelCart = new ModelCart();
        $total = $modelCart->total();
        $options = $this->cart->CartItems()->with('Options')->get();
        return view('livewire.CartPage.qty-in-cart-page', compact('options', 'total'));
    }
    public function updateUp($id)
    {
        $c = new ModelCart();
        $c->updateUp(1, $id);
    }
    public function updateDown($id)
    {
        $c = new ModelCart();
        $c->updateDown(1, $id);
    }
    public function delete($id)
    {
        $c = new ModelCart();
        $c->delete($id);
    }
    public function empty()
    {
        $c = new ModelCart();
        $c->empty();
    }
}
