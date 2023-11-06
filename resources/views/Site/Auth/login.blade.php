@extends('Site.Layouts.app')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                {{-- @auth --}}
                <a href="{{ route('home-site') }}" rel="nofollow">Home</a>
                {{-- @else --}}
                {{-- <a href="{{ route('welcome') }}" rel="nofollow">Home</a> --}}
                {{-- @endauth --}}
                <span></span> Login
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        @include('notify::components.notify')
                        <div class="col-lg-5">
                            <div
                                class="login_wrap widget-taber-content p-30 background-white border-radius-10 mb-md-5 mb-lg-0 mb-sm-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Login</h3>
                                    </div>
                                    @if (isset($failed_login))
                                    <div class="alert alert-warning" role="alert">
                                        {{$failed_login}}
                                    </div>
                                    @endif
                                    <form action="{{ route('post_login') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="Your Email">
                                        </div>
                                        @error('email')
                                        <div class="alert alert-warning" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <input type="password" name="password" placeholder="Password">
                                        </div>
                                        @error('password')
                                        <div class="alert alert-warning" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div class="login_footer form-group">
                                            {{-- <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox1" value="">
                                                    <label class="form-check-label"
                                                        for="exampleCheckbox1"><span>Remember me</span></label>
                                                </div>
                                            </div> --}}
                                            <a class="text-muted" href="#">Forgot password?</a>
                                        </div>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                name="login">Log in</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-1"></div>
                        <div class="col-lg-6">
                            <img src="assets/imgs/login.png">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@endsection