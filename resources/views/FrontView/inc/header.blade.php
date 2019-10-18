<!DOCTYPE html>
<html lang="en">
<head>
	<title>Coza Store</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{asset('FrontEnd')}}/market/images/icons/favicon.png"/>
<!--===============================================================================================-->
<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/css/util.css">
	<link rel="stylesheet" type="text/css" href="{{asset('FrontEnd')}}/market/css/main.css">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop" >
				<div class="top-bar">
						<div class="content-topbar flex-sb-m h-full container">
							<div class="left-top-bar">
									You Should Sing in To Purchase
							</div>
		
							<div class="right-top-bar flex-w h-full">
								
							@if (Auth::guest())
							<a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
									Sign up
								</a>
							@else
														
							<a class="flex-c-m trans-04 p-lr-25" style="color:beige">Welcome {{ Auth::user()->name }}</a>
							<a class="flex-c-m trans-04 p-lr-25" href=""
                        	 onclick="event.preventDefault();
                       		 document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
							
							@endif
							@if (Auth::user())
							@if (Auth::user()->user_type == 0)
							<a class="flex-c-m trans-04 p-lr-25" style="color:beige" href="{{ route('admin') }}">Admin Portal</a>	
							@endif
							@endif
						
							
							</div>
						</div>
					</div>
			<div class="wrap-menu-desktop" >
				<nav class="limiter-menu-desktop container" >
					
					<!-- Logo desktop -->		
					<a href="{{ route('index') }}" class="logo">
						<img src="{{asset('FrontEnd')}}/market/images/icons/logo-01.png" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							
							<li>
							<a href="{{ route('index') }}">Home</a>
							</li>

							<li class="label1" data-label1="hot">
							<a href="{{ route('shop') }}">Shop</a>
							</li>

							<li>
								<a href="">About</a>
							</li>

							<li>
								<a href="{{route('contact')}}">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						
					<div class="cartnumber" >
						@if (Auth::user())
							
						
					<div id="num" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart num" data-notify="{{ $count }}">
							<i class="zmdi zmdi-shopping-cart ico"></i>
						</div>
						@endif
					</div>
						

						
					</div>
				</nav>
			</div>	
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="index.html"><img src="{{asset('FrontEnd')}}/market/images/icons/logo-01.png" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				
				<div class="cartnumber" >
					@if (Auth::user())
				
					<div id="" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart num " data-notify="{{ $count }}">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
					
					@endif
				
				</div>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
				<ul class="topbar-mobile">
						<li>
							<div class="left-top-bar">
							 You Should Sing in To Purchase
							</div>
						</li>
		
						<li>
							<div class="right-top-bar flex-w h-full">
							
		
								<a href="#" class="flex-c-m p-lr-10 trans-04">
									My Account
								</a>
		
							
							</div>
						</li>
					</ul>
			<ul class="main-menu-m">
							<li>
								<a href="{{ route('index') }}">Home</a>
							</li>

							<li class="label1" data-label1="hot">
								<a href="{{ route('shop') }}">Shop</a>
							</li>

							<li>
								<a href="about.html">About</a>
							</li>

							<li>
								<a href="{{route('contact')}}">Contact</a>
							</li>
			</ul>
		</div>

	</header>
	<div class="wrap-header-cart js-panel-cart">
			<div class="s-full js-hide-cart"></div>
		
			<div class="header-cart flex-col-l p-l-65 p-r-25">
				<div class="header-cart-title flex-w flex-sb-m p-b-8">
					<span class="mtext-103 cl2">
						Your Cart
					</span>
		
					<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
						<i class="zmdi zmdi-close"></i>
					</div>
				</div>
				
				<div class="header-cart-content flex-w js-pscroll crty" id="cart">
					<ul class="header-cart-wrapitem w-full cartinfo">
						@if (Auth::user())
							
					
							@foreach($data as $x)
							@foreach ($products as $item)
						@if ($x->product_id == $item->id)
	
					<li class='header-cart-item flex-w flex-t m-b-12' id='{{ $item->price }}' hh='{{ $item->id }}'>
								<div class='header-cart-item-img imgcart'>
								<img src='{{asset('uploads')}}/{{ $item->img }}' class='imgc'>
								</div>
								<div class='header-cart-item-txt p-t-8 name_price_cart'>
								<a class='header-cart-item-name m-b-18 hov-cl1 trans-04 namecart' style='height:6px;'>{{ $item->name }}</a>
								<span class='header-cart-item-info pricecart'> EGP {{ $item->price }}</span>
								</div>
							</li>
							@endif
							@endforeach
							@endforeach

							@endif
					
		<br>
					
					</ul>
					
					<div class="w-full">
						<h4> Total Price : EGP  </h4>
						@if (Auth::user())
						<div class="header-cart-total w-full p-tb-40 total_price">{{ $total_price }}</div> 
						@endif
					
		
						<div class="header-cart-buttons flex-w w-full ">
						<a href="{{ route('cart_details') }}" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
								Check Out
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	@yield('header')