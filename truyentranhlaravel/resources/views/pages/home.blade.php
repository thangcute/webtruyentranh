@extends('welcome')
@section('content')
<div class="features_items"><!--features_items-->
						<br>
						<h2 class="title text-center">Truyện mới nhất</h2>
						@foreach($all_product as $key => $product)
						
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											
											<a href="{{URL::to('/chi-tiet-san-pham/'.$product->sanpham_id)}}">
												<img src="{{URL::to('public/upload/product/'.$product->sanpham_image)}}" alt="" />
												<h2>{{number_format($product->sanpham_price).' '.'VNĐ'}}</h2>
												<p>{{$product->sanpham_name}}</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
											</a>
											
											
											
										</div>
										
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
										<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
									</ul>
								</div>
							</div>
						</div>
						
						@endforeach
						
					</div><!--features_items-->

@stop