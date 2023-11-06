@extends('Site.Layouts.app')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="{{ route('home-site') }}" rel="nofollow">Home</a>
                <span></span> Shop
                <span></span> Your Cart
            </div>
        </div>
    </div>
    @include('notify::components.notify')
    {{-- @if($cart) --}}
    @livewire('qty-in-cart-page')
    {{-- @else
    <section class="mt-50 mb-50">
        <div class="container">
            <div class="row" style="margin-left:12em;font-size:3em;color:#F15412">
                No Item Yet!!
            </div>
            <div class="cart-action text-end">
                <a href="{{ route('get_shop') }}" class="btn "><i class="fi-rs-shopping-bag mr-10"></i>Continue
                    Shopping</a>
            </div>
        </div>
    </section>
    @endif --}}
</main>
@endsection