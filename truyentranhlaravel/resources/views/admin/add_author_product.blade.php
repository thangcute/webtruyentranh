@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm tác giả truyện
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
                                <form role="form" action="save-author-product" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tác giả</label>
                                    <input type="text" name="author_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" name="author_adress" class="form-control" id="exampleInputEmail1" placeholder="địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="author_sdt" class="form-control" id="exampleInputEmail1" placeholder="số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" name="author_birthday" class="form-control" id="exampleInputEmail1" placeholder="ngày sinh">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả tác giả</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="author_desc" id="exampleInputPassword1" placeholder="mô tả tác giả"></textarea>
                                </div>
                                
                                <button type="submit" name="add_author_product" class="btn btn-info">Thêm tác giả</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>

@stop