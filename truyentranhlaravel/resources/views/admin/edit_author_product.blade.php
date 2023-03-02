@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật tác giả
                        </header>
                            <?php
                            $message=Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_author_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-author-product/'.$edit_value->author_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên tác giả</label>
                                    <input type="text" value="{{$edit_value->author_name}}" name="author_name" class="form-control" id="exampleInputEmail1" placeholder="Tên tác giả">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" value="{{$edit_value->author_adress}}" name="author_adress" class="form-control" id="exampleInputEmail1" placeholder="địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" value="{{$edit_value->author_sdt}}" name="author_sdt" class="form-control" id="exampleInputEmail1" placeholder="số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Ngày sinh</label>
                                    <input type="date" value="{{$edit_value->author_birthday}}" name="author_birthday" class="form-control" id="exampleInputEmail1" placeholder="ngày sinh">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả tác giả</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="author_desc" id="exampleInputPassword1" placeholder="mô tả tác giả">{{$edit_value->author_desc}}</textarea>
                                </div>
                                
                                
                                <button type="submit" name="update_author_product" class="btn btn-info">Cập nhật tác giả</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
            
        </div>

@stop