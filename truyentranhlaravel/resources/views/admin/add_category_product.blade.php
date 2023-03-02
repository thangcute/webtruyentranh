@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm loại truyện
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
                                <form role="form" action="save-category-product" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên loại</label>
                                    <input type="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="category_product_desc" id="exampleInputPassword1" placeholder="mô tả danh mục"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Hiển thị</label>
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">hiển thị</option>
                                        <option value="1">ẩn</option>
                                    </select>
                                </div>
                                
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm loại</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>

@stop