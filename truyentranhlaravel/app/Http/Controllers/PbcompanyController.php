<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class PbcompanyController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function add_pbcompany_product(){
        $this->authlogin();
        return view('admin.add_pbcompany_product');
    }
    public function all_pbcompany_product(){
        $this->authlogin();
        $all_pbcompany_product=DB::table('tbl_pbcompany')->get();
        $manager_pbcompany_product=view('admin.all_pbcompany_product')->with('all_pbcompany_product',$all_pbcompany_product);
        return view('admin-layout')->with('admin.all_pbcompany_product',$manager_pbcompany_product);
    }
    public function save_pbcompany_product(Request $request){
        $data=array();
        $data['pbcompany_name']=$request->pbcompany_name;
        $data['pbcompany_adress']=$request->pbcompany_adress;
        $data['pbcompany_sdt']=$request->pbcompany_sdt;
        $data['pbcompany_desc']=$request->pbcompany_desc;

        DB::table('tbl_pbcompany')->insert($data);
        session::put('message','thêm nhà xuất bản thành công!');
        return Redirect::to('add-pbcompany-product');
    }
    public function edit_pbcompany_product($pbcompany_product_id){
        $this->authlogin();
        $edit_pbcompany_product=DB::table('tbl_pbcompany')->where('pbcompany_id',$pbcompany_product_id)->get();
        $manager_pbcompany_product=view('admin.edit_pbcompany_product')->with('edit_pbcompany_product',$edit_pbcompany_product);
        return view('admin-layout')->with('admin.edit_pbcompany_product',$manager_pbcompany_product);
    }
    public function update_pbcompany_product(Request $request, $pbcompany_product_id){
        $data=array();
        $data['pbcompany_name']=$request->pbcompany_name;
        $data['pbcompany_adress']=$request->pbcompany_adress;
        $data['pbcompany_sdt']=$request->pbcompany_sdt;
        $data['pbcompany_desc']=$request->pbcompany_desc;
        DB::table('tbl_pbcompany')->where('pbcompany_id',$pbcompany_product_id)->update($data);
        session::put('message','cập nhật nhà xuất bản thành công!');
        return Redirect::to('all-pbcompany-product');
    }
    public function delete_pbcompany_product($pbcompany_product_id){
        DB::table('tbl_pbcompany')->where('pbcompany_id',$pbcompany_product_id)->delete();
        session::put('message','xoá nhà xuất bản thành công!');
        return Redirect::to('all-pbcompany-product');
    }
}
