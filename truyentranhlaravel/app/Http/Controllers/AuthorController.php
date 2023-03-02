<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AuthorController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function add_author_product(){
        $this->authlogin();
        return view('admin.add_author_product');
    }
    public function all_author_product(){
        $this->authlogin();
        $all_author_product=DB::table('tbl_author')->get();
        $manager_author_product=view('admin.all_author_product')->with('all_author_product',$all_author_product);
        return view('admin-layout')->with('admin.all_author_product',$manager_author_product);
    }
    public function save_author_product(Request $request){
        $data=array();
        $data['author_name']=$request->author_name;
        $data['author_adress']=$request->author_adress;
        $data['author_sdt']=$request->author_sdt;
        $data['author_desc']=$request->author_desc;
        $data['author_birthday']=$request->author_birthday;

        DB::table('tbl_author')->insert($data);
        session::put('message','thêm tác giả truyện thành công!');
        return Redirect::to('add-author-product');
    }
    public function edit_author_product($author_product_id){
        $this->authlogin();
        $edit_author_product=DB::table('tbl_author')->where('author_id',$author_product_id)->get();
        $manager_author_product=view('admin.edit_author_product')->with('edit_author_product',$edit_author_product);
        return view('admin-layout')->with('admin.edit_author_product',$manager_author_product);
    }
    public function update_author_product(Request $request, $author_product_id){
        $data=array();
        $data['author_name']=$request->author_name;
        $data['author_adress']=$request->author_adress;
        $data['author_sdt']=$request->author_sdt;
        $data['author_desc']=$request->author_desc;
        $data['author_birthday']=$request->author_birthday;
        DB::table('tbl_author')->where('author_id',$author_product_id)->update($data);
        session::put('message','cập nhật tác giả thành công!');
        return Redirect::to('all-author-product');
    }
    public function delete_author_product($author_product_id){
        DB::table('tbl_author')->where('author_id',$author_product_id)->delete();
        session::put('message','xoá tác giả thành công!');
        return Redirect::to('all-author-product');
    }
    //end function admin pages
    
    public function show_author_home($author_id){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')
        ->orderby('category_id','desc')->get();

        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        $author_by_id = DB::table('tbl_sanpham')
        ->join('tbl_author','tbl_sanpham.author_id','=','tbl_author.author_id')
        ->where('tbl_sanpham.author_id',$author_id)->get();

        $author_name = DB::table('tbl_author')
        ->where('tbl_author.author_id',$author_id)->limit(1)->get();

        return view('pages.author.show_author')
        ->with('category',$cate_product)
        ->with('author',$author_product)
        ->with('author_by_id',$author_by_id)
        ->with('author_name',$author_name);                                                                                                                                                                                                                                                                                                                                                                                                          
    }
}
