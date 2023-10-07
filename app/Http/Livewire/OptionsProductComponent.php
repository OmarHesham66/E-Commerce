<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\UserOrder;
use App\Traits\Get_Cookies;
use App\Models\OptionsProduct;
use App\Repository\Cart\ModelCart;
use App\Traits\PreviousOrder;
use Illuminate\Support\Facades\Auth;


class OptionsProductComponent extends Component
{
    use Get_Cookies, PreviousOrder;
    public $colors, $sizes, $total, $quantity, $activeColor, $activeSize;
    public $selected_qty, $errorMassage = null, $product_id;
    protected $listeners = ['newfresh' => 'update'];

    public function mount($product_id)
    {
        $this->product_id = $product_id;
        $options = OptionsProduct::where('product_id', $this->product_id);
        $this->sizes = array_unique($options->pluck('size')->toArray());
        $this->total = $this->quantity = $options->sum('quantity');
    }
    public function render()
    {
        return view('livewire.ProductPage.options-product-component');
    }
    public function SizeByColor($size)
    {
        if ($this->activeSize == $size) {
            $this->activeSize = null;
            $this->activeColor = null;
            $this->colors = null;
            $this->quantity = $this->total;
        } else {
            $this->activeSize = $size;
            $this->activeColor = null;
            $options = OptionsProduct::where('product_id', $this->product_id);
            $this->colors = $options->where('size', $size)->pluck('hexa')->toArray();
            $this->quantity = $options->where('size', $size)->sum('quantity');
            // dd($this->quantity);
        }
    }
    public function ColorBySize($color)
    {
        $options = OptionsProduct::where('product_id', $this->product_id);
        if ($this->activeColor == $color) {
            $this->activeColor = null;
            $this->quantity = $options->where('size', $this->activeSize)->sum('quantity');
        } else {
            $this->quantity = $options->where('size', $this->activeSize)->where('hexa', $color)->sum('quantity');
            $this->activeColor = $color;
        }
    }
    public function save()
    {
        if ($this->activeSize == null) {
            $this->errorMassage = 'Please Choose Size !!';
        } elseif ($this->activeColor == null) {
            $this->errorMassage = 'Please Choose Color !!';
        } else {
            if (!$this->selected_qty) {
                $this->selected_qty = 1;
            }
            $selected_option = OptionsProduct::where('product_id', $this->product_id)
                ->where('hexa', $this->activeColor)
                ->where('size', $this->activeSize)->first();
            $cart = new ModelCart();
            $cart->add($selected_option->id, $this->selected_qty, $this->product_id);
            $this->check();
            $this->emit('newfresh');
            $this->emit('incermentNumber');
        }
    }

    public function update()
    {
        $this->activeSize = null;
        $this->activeColor = null;
        $this->colors = null;
        $this->quantity = $this->total;
        $options = OptionsProduct::where('product_id', $this->product_id);
        $this->sizes = array_unique($options->pluck('size')->toArray());
        $this->total = $this->quantity = $options->sum('quantity');
    }
}
