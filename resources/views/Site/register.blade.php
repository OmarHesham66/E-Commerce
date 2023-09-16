@extends('Layouts.app')
@section('content')
<main class="main">
    <div class="page-header breadcrumb-wrap">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.html" rel="nofollow">Home</a>
                <span></span> Register
            </div>
        </div>
    </div>
    <section class="pt-150 pb-150">
        <div class="container">
            <div class="row">
                <div class="col-lg-10 m-auto">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="login_wrap widget-taber-content p-30 background-white border-radius-5">
                                <div class="padding_eight_all bg-white">
                                    <div class="heading_s1">
                                        <h3 class="mb-30">Create an Account</h3>
                                    </div>
                                    <form action="{{ route('post_register') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" name="name" placeholder="Name">
                                        </div>
                                        @error('name')
                                        <div class="alert alert-warning" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <input type="text" name="email" placeholder="Email">
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
                                        <div class="form-group">
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm password">
                                        </div>
                                        @error('password_confirmation')
                                        <div class="alert alert-warning" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <input type="file" name="photo" id="user-photo"
                                                style="display: none!important;">
                                            <button class="btn btn-fill-out btn-block hover-up" id="btn-user-photo"
                                                style="padding: 12px!important;background-color:rgb(255, 80, 80)!important;">Upload
                                                Photo</button>
                                        </div>
                                        {{-- #######################################3 --}}
                                        <script>
                                            let btn_photo= document.getElementById('btn-user-photo');
                                            btn_photo.addEventListener('click',function(e){
                                                e.preventDefault();
                                                document.getElementById('user-photo').click();
                                            })
                                        </script>
                                        {{-- ####################################################################333
                                        --}}
                                        <div class="login_footer form-group">
                                            <div class="chek-form">
                                                <div class="custome-checkbox">
                                                    <input class="form-check-input" type="checkbox" name="checkbox"
                                                        id="exampleCheckbox12" value="">
                                                    <label class="form-check-label" for="exampleCheckbox12"><span>I
                                                            agree to terms &amp; Policy.</span></label>
                                                </div>
                                            </div>
                                            <a href="privacy-policy.html"><i
                                                    class="fi-rs-book-alt mr-5 text-muted"></i>Lean more</a>
                                        </div>
                                        @error('checkbox')
                                        <div class="alert alert-warning" role="alert">
                                            {{$message}}
                                        </div>
                                        @enderror
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-fill-out btn-block hover-up"
                                                name="login">Submit &amp; Register</button>
                                        </div>
                                    </form>
                                    <div class="text-muted text-center">Already have an account? <a href="#">Sign in
                                            now</a></div>
                                </div>
                            </div>
                        </div>
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