<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>@yield('title')</title>
   
    <link href="{{ elixir('css/all.css') }}" rel="stylesheet">

</head><!--/head-->

<body>
<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> (18) 5555-5555</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> atendimento@schoolofnet.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="http://www.facebook.com">
                                <i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://twitter.com">
                                <i class="fa fa-twitter"></i></a></li>
                            <li><a href="https://plus.google.com">
                                <i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>                    
                </div>
            </div>
        </div>
    </div><!--/header_top-->

    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="/home"><span>CodeCommerce</span></a>
                    </div>

                </div>
                <div class="col-sm-8">
                    <div class="shop-menu pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="{{route('account.orders')}}"><i class="fa fa-user"></i> Minha conta</a></li>
                            <li><a href="#"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="{{route('cart')}}"><i class="fa fa-shopping-cart"></i> Carrinho</a></li>

                            @if (Auth::guest())
                                <li><a href="/auth/login"><i class="fa fa-lock"></i>Login</a></li>
                            @else
                                <li><a href="{{ url('/auth/logout') }}"><i class="fa fa-lock"></i>Sair ({{ Auth::user()->name }})</a></li>
                            @endif 

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="{{route('home')}}" class="active">Home</a></li>
                            <li><a href="{{route('painel.index')}}">Administração</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="#">Products</a></li>
                                    <li><a href="#">Product Details</a></li>
                                    <li><a href="#">Checkout</a></li>
                                    <li><a href="{{route('cart')}}">Cart</a></li>
                                    <li><a href="/auth/login">Login</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Contact</a></li>
                            
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <input type="text" placeholder="Buscar"/>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

<section>
    <div class="container">
        <div class="row">

            @yield('categories')

            @yield('content')

        </div>
    </div>
    <div class="common-modal modal fade" id="common-Modal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <ul class="list-inline item-details">
                <li><a href="http://themifycloud.com">ThemifyCloud</a></li>
                <li><a href="http://themescloud.org">ThemesCloud</a></li>
            </ul>
        </div>
    </div>
</section>

<footer id="footer"><!--Footer-->

    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <p class="pull-left">Copyright © 2016 E-Shop Inc. All rights reserved.</p>
                <p class="pull-right">Designed by <span><a target="_blank" href="http://invoinn.com/">InvoInn</a></span></p>
            </div>
        </div>
    </div>

</footer><!--/Footer-->

<script src="{{ elixir('js/all.js') }}"></script>

</body>
</html>