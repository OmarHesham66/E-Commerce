<header class="header-area header-style-1 header-height-2">
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                {{-- <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li>
                                <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> English <i
                                        class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-fr.png')}}"
                                                alt="">Français</a>
                                    </li>
                                    <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-dt.png')}}"
                                                alt="">Deutsch</a></li>
                                    <li><a href="#"><img src="{{ asset('assets/imgs/theme/flag-ru.png')}}"
                                                alt="">Pусский</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div> --}}
                <div class="col-xl-3 col-lg-4">
                    {{-- <div class="header-info"> --}}
                        <div class="text-center">
                            <div id="news-flash" class="d-inline-block">
                                <ul>
                                    <li>Get great devices up to 50% off <a href="{{ route('get_shop') }}">View
                                            details</a></li>
                                    <li>Supper Value Deals - Save more with coupons</li>
                                    <li>Trendy 25silver jewelry, save up 35% off today <a
                                            href="{{ route('get_shop') }}">Shop
                                            now</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        {{--
                    </div> --}}
                </div>
                @auth
                <div class="col-xl-9 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li><i class="fi-rs-key"></i>
                                <a href="{{ route('get_logout') }}">Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @else
                <div class="col-xl-9 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li><i class="fi-rs-key"></i>
                                <a href="{{ route('get_login') }}">Log In </a> /
                                <a href="{{ route('get_register') }}">Sign Up</a>
                            </li>
                        </ul>
                    </div>
                </div>
                @endauth
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="{{ route('home-site') }}">
                        <img src="{{ asset('assets/imgs/logo/logo.png')}}" alt="logo">
                    </a>
                </div>
                <div class="header-right">
                    <div class="search-style-1">
                        <form action="{{ route('get_shop') }}" method="post">
                            @csrf
                            <input type="text" name="text" placeholder="Search for items...">
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            @livewire('number-of-cart')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="{{ route('home-site') }}"><img src="{{ asset('assets/imgs/logo/logo.png')}}"
                            alt="logo"></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                        <nav>
                            <ul>
                                <li><a class="active" href="{{ route('home-site') }}">Home</a></li>
                                {{-- <li><a href="about.html">About</a></li> --}}
                                <li><a href="{{ route('get_shop') }}">Shop</a></li>
                                <li class="position-static"><a href="#">Our Collections <i
                                            class="fi-rs-angle-down"></i></a>
                                    <ul class="mega-menu">
                                        @foreach (App\Models\SuperCategory::with('Categories')->get() as $super)
                                        <li class="sub-mega-menu sub-mega-menu-width-22">
                                            <a class="menu-title" href="#">{{ $super->name }}</a>
                                            <ul>
                                                @foreach ($super->Categories as $category)
                                                <li><a href="{{ route('get_shop',['category'=>$category->id]) }}">{{
                                                        $category->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        @endforeach
                                        <li class="sub-mega-menu sub-mega-menu-width-34">
                                            <div class="menu-banner-wrap">
                                                <a href="{{ route('get_shop') }}"><img
                                                        src="{{ asset('assets/imgs/banner/menu-banner.jpg')}}"
                                                        alt="Surfside Media"></a>
                                                <div class="menu-banner-content">
                                                    <h4>Hot deals</h4>
                                                    <h3>Don't miss<br> Trending</h3>
                                                    <div class="menu-banner-price">
                                                        <span class="new-price text-success">Save to 50%</span>
                                                    </div>
                                                    <div class="menu-banner-btn">
                                                        <a href="{{ route('get_shop') }}">Shop now</a>
                                                    </div>
                                                </div>
                                                <div class="menu-banner-discount">
                                                    <h3>
                                                        <span>35%</span>
                                                        off
                                                    </h3>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                {{-- <li><a href="blog.html">Blog </a></li> --}}
                                {{-- <li><a href="contact.html">Contact</a></li> --}}
                                @auth
                                <li><a href="{{ route('account.index') }}">My Account ({{ Auth::user()->name }})<i
                                            class="fi-rs-angle-down"></i></a>
                                    <ul class="sub-menu">
                                        <li><a href="{{ route('account.index') }}">Dashboard</a></li>
                                        <li><a href="{{ route('account.index') }}">My-Orders</a></li>
                                        <li><a href="{{ route('get_logout') }}">Logout</a></li>
                                    </ul>
                                </li>
                                @endauth
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="hotline d-none d-lg-block">
                    <p><i class="fi-rs-smartphone"></i><span>Toll Free</span> (+02) 0111-502-9466 </p>
                </div>
                {{-- <p class="mobile-promotion">Happy <span class="text-brand">Mother's Day</span>. Big Sale Up to
                    40%
                </p> --}}
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2 d-block d-lg-none">
                            <div class="burger-icon burger-icon-white">
                                <span class="burger-icon-top"></span>
                                <span class="burger-icon-mid"></span>
                                <span class="burger-icon-bottom"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ route('home-site') }}"><img src="{{ asset('assets/imgs/logo/logo.png')}}" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span> Browse Categories
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-dress"></i>Women's
                                    Clothing</a>
                            </li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-tshirt"></i>Men's
                                    Clothing</a></li>
                            <li> <a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-smartphone"></i>
                                    Cellphones</a>
                            </li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-desktop"></i>Computer &
                                    Office</a>
                            </li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-cpu"></i>Consumer
                                    Electronics</a>
                            </li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-home"></i>Home &
                                    Garden</a></li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-high-heels"></i>Shoes</a>
                            </li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-teddy-bear"></i>Mother &
                                    Kids</a>
                            </li>
                            <li><a href="{{ route('get_shop') }}"><i class="surfsidemedia-font-kite"></i>Outdoor fun</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('home-site') }}">Home</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="{{ route('get_shop') }}">shop</a>
                        </li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Our
                                Collections</a>
                            <ul class="dropdown">
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Women's
                                        Fashion</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Dresses</a></li>
                                        <li><a href="product-details.html">Blouses & Shirts</a></li>
                                        <li><a href="product-details.html">Hoodies & Sweatshirts</a></li>
                                        <li><a href="product-details.html">Women's Sets</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Men's
                                        Fashion</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Jackets</a></li>
                                        <li><a href="product-details.html">Casual Faux Leather</a></li>
                                        <li><a href="product-details.html">Genuine Leather</a></li>
                                    </ul>
                                </li>
                                <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                        href="#">Technology</a>
                                    <ul class="dropdown">
                                        <li><a href="product-details.html">Gaming Laptops</a></li>
                                        <li><a href="product-details.html">Ultraslim Laptops</a></li>
                                        <li><a href="product-details.html">Tablets</a></li>
                                        <li><a href="product-details.html">Laptop Accessories</a></li>
                                        <li><a href="product-details.html">Tablet Accessories</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{-- <li class="menu-item-has-children"><span class="menu-expand"></span><a
                                href="blog.html">Blog</a></li>
                        <li class="menu-item-has-children"><span class="menu-expand"></span><a href="#">Language</a>
                            <ul class="dropdown">
                                <li><a href="#">English</a></li>
                                <li><a href="#">French</a></li>
                                <li><a href="#">German</a></li>
                                <li><a href="#">Spanish</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info mt-30">
                    <a href="contact.html"> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('get_login') }}">Log In </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="{{ route('get_register') }}">Sign Up</a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#">(+02) 0111-502-9466 </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Follow Us</h5>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                <a href="#"><img src="{{ asset('assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
            </div>
        </div>
    </div>
</div>