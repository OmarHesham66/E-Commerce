<form wire:submit.prevent='save'>
    @csrf
    @isset($colors)
    <div class="attr-detail attr-color mb-15">
        <strong class="mr-10">Color</strong>
        <ul class="list-filter color-filter">
            @foreach ($colors as $color)
            @if ($color == $activeColor)
            <li wire:click="ColorBySize('{{ $color }}')" class="active"><a href="#" data-color="{{ $color }}">
                    <span style="background: {{ $color }}"></span></a>
            </li>
            @else
            <li wire:click="ColorBySize('{{ $color }}')"><a href="#" data-color="{{ $color }}">
                    <span style="background: {{ $color }}"></span></a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    @endisset
    <div class=" attr-detail attr-size">
        <strong class="mr-10">Size</strong>
        <ul class="list-filter size-filter font-small">
            @foreach ($sizes as $size)
            @if($size == $activeSize)
            <li class="active">
                <a wire:click="SizeByColor('{{ $size }}')" href="#">{{$size}}</a>
            </li>
            @else
            <li>
                <a wire:click="SizeByColor('{{ $size }}')" href="#">{{ $size }}</a>
            </li>
            @endif
            @endforeach
        </ul>
    </div>
    <div class="bt-1 border-color-1 mt-30 mb-30"></div>
    <div class="detail-extralink">
        <select class="detail-qty border radius" wire:model.defer='selected_qty' name="qty">
            {{-- <option>Select</option> --}}
            @for ($a = 1; $a <= $quantity; $a++) <option>{{ $a }}</option>
                @endfor
        </select>
        <div class="product-extra-link2">
            <button type="submit" class="button button-add-to-cart">Add to cart</button>
            {{-- <a aria-label="Add To Wishlist" class="action-btn hover-up" href="wishlist.php"><i
                    class="fi-rs-heart"></i></a>
            <a aria-label="Compare" class="action-btn hover-up" href="compare.php"><i class="fi-rs-shuffle"></i></a>
            --}}
        </div>
    </div>
    <ul class="product-meta font-xs color-grey mt-50">
        {{-- <li class="mb-5">SKU: <a href="#">FWM15VKT</a></li>
        <li class="mb-5">Tags: <a href="#" rel="tag">Cloth</a>, <a href="#" rel="tag">Women</a>, <a href="#"
                rel="tag">Dress</a> </li> --}}
        <li>Availability:<span class="in-stock text-success ml-5">{{$total}} Items In Stock</span></li>
    </ul>
</form>
<script>
    colo
</script>