@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật truyện
                        </header>
                        <?php
                            $message=Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            
                            <div class="position-center">
                                @foreach($edit_product as $key => $product_pro)
                                <form role="form" action="{{URL::to('/update-product/'.$product_pro->sanpham_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên truyện</label>
                                    <input type="text" name="sanpham_name" class="form-control" id="exampleInputEmail1" value="{{$product_pro->sanpham_name}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá truyện</label>
                                    <input type="text" name="sanpham_price" class="form-control" id="exampleInputEmail1" value="{{$product_pro->sanpham_price}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh truyện</label>
                                    <input type="file" name="sanpham_image" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('public/upload/product/'.$product_pro->sanpham_image)}}" height="100" width="100" alt="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Năm xuất bản</label>
                                    <input type="date" name="sanpham_pbyear" class="form-control" id="exampleInputEmail1" value="{{$product_pro->sanpham_pbyear}}">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả truyện</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="sanpham_desc" id="exampleInputPassword1">{{$product_pro->sanpham_desc}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tiêu đề truyện</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="sanpham_content" id="exampleInputPassword1">{{$product_pro->sanpham_content}}</textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Danh mục truyện</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                        @if($cate->category_id==$product_pro->category_id)
                                        <option selected value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
                                        @else
                                        <option value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tác giả</label>
                                    <select name="product_author" class="form-control input-sm m-bot15">
                                        @foreach($author_product as $key =>$author)
                                        @if($author->author_id==$product_pro->author_id)
                                        <option selected value="{{($author->author_id)}}">{{($author->author_name)}}</option>
                                        @else
                                        <option value="{{($author->author_id)}}">{{($author->author_name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà xuất bản</label>
                                    <select name="product_pbcompany" class="form-control input-sm m-bot15">
                                        @foreach($pbcompany_product as $key =>$pbcompany)
                                        @if($pbcompany->pbcompany_id==$product_pro->pbcompany_id)
                                        <option selected value="{{($pbcompany->pbcompany_id)}}">{{($pbcompany->pbcompany_name)}}</option>
                                        @else
                                        <option value="{{($pbcompany->pbcompany_id)}}">{{($pbcompany->pbcompany_name)}}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="sanpham_status" class="form-control input-sm m-bot15">
                                        <option value="0">hiển thị</option>
                                        <option value="1">ẩn</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_product" class="btn btn-info">Cập nhật truyện</button>
                            </form>
                            @endforeach
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>

@stop