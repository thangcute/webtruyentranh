@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm nhà xuất bản truyện
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
                                <form role="form" action="save-pbcompany-product" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà xuất bản</label>
                                    <input type="text" name="pbcompany_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà xuất bản">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" name="pbcompany_adress" class="form-control" id="exampleInputEmail1" placeholder="địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" name="pbcompany_sdt" class="form-control" id="exampleInputEmail1" placeholder="số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả nhà xuất bản</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="pbcompany_desc" id="exampleInputPassword1" placeholder="mô tả nhà xuất bản"></textarea>
                                </div>
                                
                                <button type="submit" name="add_pbcompany_product" class="btn btn-info">Thêm nhà xuất bản</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
            
        </div>

@stop