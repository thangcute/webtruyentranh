@extends('admin-layout')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật nhà xuất bản
                        </header>
                            <?php
                            $message=Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_pbcompany_product as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-pbcompany-product/'.$edit_value->pbcompany_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên NXB</label>
                                    <input type="text" value="{{$edit_value->pbcompany_name}}" name="pbcompany_name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà xuất bản">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input type="text" value="{{$edit_value->pbcompany_adress}}" name="pbcompany_adress" class="form-control" id="exampleInputEmail1" placeholder="địa chỉ">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input type="text" value="{{$edit_value->pbcompany_sdt}}" name="pbcompany_sdt" class="form-control" id="exampleInputEmail1" placeholder="số điện thoại">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả NXB</label>
                                    <textarea style="resize: none" rows="5" class="form-control" name="pbcompany_desc" id="exampleInputPassword1" placeholder="mô tả NXB">{{$edit_value->pbcompany_desc}}</textarea>
                                </div>
                                
                                
                                <button type="submit" name="update_pbcompany_product" class="btn btn-info">Cập nhật NXB</button>
                            </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
            
        </div>

@stop