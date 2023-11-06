<?php

namespace App\Http\Livewire;

use App\Facade\Cart;
use App\Repository\Cart\ModelCart;
use App\Traits\Get_Cookies;
use Livewire\Component;

class NumberOfCart extends Component
{
    use Get_Cookies;
    public $number, $cart, $total;
    protected $listeners = ['incermentNumber' => '$refresh'];
    public function render()
    {
        $this->cart = Cart::ShowCart();
        $this->total = Cart::total();
        $this->number = (!$this->cart->count()) ?  0 : Cart::ProductNumber();
        return view('livewire.User.ProductPage.number-of-cart');
    }
}
