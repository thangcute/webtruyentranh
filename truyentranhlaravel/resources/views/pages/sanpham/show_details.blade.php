@extends('welcome')
@section('content')
@foreach($product_details as $key => $value)
<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="{{URL::to('/public/upload/product/'.$value->sanpham_image)}}" alt="" />
								<h3>ZOOM</h3>
							</div>
							

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<img src="images/product-details/new.jpg" class="newarrival" alt="" />
								<h2>{{$value->sanpham_name}}</h2>
								<p>Mã ID: {{$value->sanpham_id}}</p>
								<img src="images/product-details/rating.png" alt="" />
                                <form action="{{URL::to('/save-cart')}}" method="POST">
                                    {{ csrf_field() }}
								<span>
									<span>{{number_format($value->sanpham_price).' '.'VNĐ'}}</span>
									<label>số lượng:</label>
									<input name="qty" type="number" min="1" value="1" />
                                    <input name="productid_hidden" type="hidden" value="{{$value->sanpham_id}}" />
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm giỏ hàng
									</button>
								</span>
                                </form>
								<p><b>Tình trạng:</b> Còn hàng</p>
								<p><b>Điều kiện:</b> mới 100%</p>
								<p><b>Tác giả:</b> {{$value->author_name}}</p>
                                <p><b>Loại:</b> {{$value->category_name}}</p>
                                <p><b>nhà phát hành:</b> {{$value->pbcompany_name}}</p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
</div><!--/product-details-->

                    <div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#details" data-toggle="tab">Mô tả truyện</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Chi tiết truyện</a></li>
								
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
                                <p>{!!$value->sanpham_desc!!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
                                <p>{!!$value->sanpham_content!!}</p>
							</div>
							
							
						</div>
					</div><!--/category-tab-->
                    @endforeach
                    <div class="recommended_items"><!--recommended_items-->
                    <br>
						<h2 class="title text-center">Truyện liên quan</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">
                                    @foreach($relate as $key => $lienquan)	
									<div class="col-sm-4">
										<div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="{{URL::to('public/upload/product/'.$lienquan->sanpham_image)}}" alt="" />
                                                    <h2>{{number_format($lienquan->sanpham_price).' '.'VNĐ'}}</h2>
                                                    <p>{{$lienquan->sanpham_name}}</p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm giỏ hàng</a>
                                                </div>
										
								            </div>
										</div>
									</div>
                                    @endforeach
								</div>
                               
								
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
@stop