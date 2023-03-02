@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm truyện
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
                                <form role="form" action="save-product" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên truyện</label>
                                    <input type="text" name="sanpham_name" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Giá truyện</label>
                                    <input type="text" name="sanpham_price" class="form-control" id="exampleInputEmail1" placeholder="Tên sản phẩm">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh truyện</label>
                                    <input type="file" name="sanpham_image" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày xuất bản</label>
                                    <input type="date" name="sanpham_pbyear" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả truyện</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="sanpham_desc" placeholder="mô tả sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tiêu đề truyện</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="sanpham_content" placeholder="tiêu đề sản phẩm"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại truyện</label>
                                    <select name="product_cate" class="form-control input-sm m-bot15">
                                        @foreach($cate_product as $key =>$cate)
                                        <option value="{{($cate->category_id)}}">{{($cate->category_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Tác giả</label>
                                    <select name="product_author" class="form-control input-sm m-bot15">
                                        @foreach($author_product as $key =>$author)
                                        <option value="{{($author->author_id)}}">{{($author->author_name)}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà xuất bản</label>
                                    <select name="product_pbcompany" class="form-control input-sm m-bot15">
                                        @foreach($pbcompany_product as $key =>$pbcompany)
                                        <option value="{{($pbcompany->pbcompany_id)}}">{{($pbcompany->pbcompany_name)}}</option>
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
                                
                                <button type="submit" name="add_product" class="btn btn-info">Thêm truyện</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>

@stop