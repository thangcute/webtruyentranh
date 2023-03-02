<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class CategoryProduct extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function add_category_product(){
        $this->authlogin();
        return view('admin.add_category_product');
    }
    public function all_category_product(){
        $this->authlogin();
        $all_category_product=DB::table('tbl_category_product')->get();
        $manager_category_product=view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin-layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function save_category_product(Request $request){
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        $data['category_status']=$request->category_product_status;

        DB::table('tbl_category_product')->insert($data);
        session::put('message','thêm loại truyện thành công!');
        return Redirect::to('add-category-product');
    }
    public function unactive_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        session::put('message','không kích hoạt loại truyện thành công!');
        return Redirect::to('all-category-product');
    }
    public function active_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        session::put('message','kích hoạt loại truyện thành công!');
        return Redirect::to('all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->authlogin();
        $edit_category_product=DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product=view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin-layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id){
        $data=array();
        $data['category_name']=$request->category_product_name;
        $data['category_desc']=$request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        session::put('message','cập nhật loại truyện thành công!');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        session::put('message','xoá loại truyện thành công!');
        return Redirect::to('all-category-product');
    }

    //end function admin page
    public function show_category_home($category_id){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')
        ->orderby('category_id','desc')->get();
        
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        $category_by_id = DB::table('tbl_sanpham')
        ->join('tbl_category_product','tbl_sanpham.category_id','=','tbl_category_product.category_id')
        ->where('tbl_sanpham.category_id',$category_id)->get();

        $category_name = DB::table('tbl_category_product')
        ->where('tbl_category_product.category_id',$category_id)->limit(1)->get();

        return view('pages.category.show_category')
        ->with('category',$cate_product)
        ->with('author',$author_product)
        ->with('category_by_id',$category_by_id)
        ->with('category_name',$category_name);                                                                                                                                                                                                                                                                                                                                                                                                          
    }
    
}
