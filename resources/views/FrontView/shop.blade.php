@extends('FrontView.inc.header')
@section('header')

<br><br><br><br>


<!-- Product -->
<section class="bg0 p-t-23 p-b-140">
	<div class="container">
		

		<div class="flex-w flex-sb-m p-b-52">
			<div class="flex-w flex-l-m filter-tope-group m-tb-10">
				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5 how-active1" data-filter="*">
					All Products
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".2">
					Mobiles
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".1">
					Cameras
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".4">
					Bags
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".3">
					Shoes
				</button>

				<button class="stext-106 cl6 hov1 bor3 trans-04 m-r-32 m-tb-5" data-filter=".5">
					Flash Disks
				</button>
			</div>

			<div class="flex-w flex-c-m m-tb-10">
			

			
			</div>
			
			<!-- Search product -->
			<div class="dis-none panel-search w-full p-t-10 p-b-15">
				<div class="bor8 dis-flex p-l-15">
					<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>

					<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search-product" placeholder="Search">
				</div>	
			</div>

			<!-- Filter -->
			
		</div>

		<div class="row isotope-grid">
			@foreach ($products as $product)
			<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item {{$product->categ}}">
				<!-- Block2 -->
				<div class="block2">
					<div class="block2-pic hov-img0">
					<img src="{{asset('uploads')}}/{{$product->img}}" alt="IMG-PRODUCT">
					<input type="hidden" class="id" id="{{$product->id}}">
						<a href="" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1 view ">
							Quick View
						</a>
					</div>

					<div class="block2-txt flex-w flex-t p-t-14">
						<div class="block2-txt-child1 flex-col-l ">
							<a href="product-detail.html"  class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 ">
								{{$product->name}}
							</a>
						
							<span class="stext-105 cl3">
								EGP {{$product->price}}.00
							</span>
						</div>

						
					</div>
				</div>
			</div>
			@endforeach
		<!-- Load more -->
	
	</div>
	
</section>


	@include('FrontView.inc.footer')
@endsection