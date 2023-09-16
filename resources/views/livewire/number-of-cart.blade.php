<div class="header-action-icon-2">
    <a class="mini-cart-icon" href="cart.html">
        <img alt="Surfside Media" src="{{ asset('assets/imgs/theme/icons/icon-cart.svg')}}">
        <span class="pro-count blue">{{$number}}</span>
    </a>
    {{-- @isset($cart_item) --}}
    <div class="cart-dropdown-wrap cart-dropdown-hm2">
        <ul>
            @forelse ($cart as $item)
            <li>
                <div class="shopping-cart-img">
                    <a href="product-details.html"><img alt="Surfside Media"
                            src="{{ asset('assets/imgs/shop/thumbnail-3.jpg')}}"></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="product-details.html">{{ $item->name }}</a></h4>
                    <h4><span>{{ $item->quantity }} × </span>${{ $item->price }}</h4>
                </div>
                <div class="shopping-cart-delete">
                    <a href="#"><i class="fi-rs-cross-small"></i></a>
                </div>
            </li>
            @empty
            <li>
                <div class="shopping-cart-title">
                    <h3>No Item Yet !!</h3>
                </div>
            </li>
            @endforelse
        </ul>
        <div class="shopping-cart-footer">
            @if($cart->count()!=0)
            <div class="shopping-cart-total">
                <h4>Total <span>${{ $total}}</span></h4>
            </div>
            @endif
            <div class="shopping-cart-button">
                <a href="cart.html" class="outline">View cart</a>
                <a href="checkout.html">Checkout</a>
            </div>
        </div>
    </div>
</div>