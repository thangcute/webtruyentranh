<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class ProductController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function add_product(){
        $this->authlogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();
        $pbcompany_product=DB::table('tbl_pbcompany')->orderby('pbcompany_id','desc')->get();
        
        return view('admin.add_product')->with('cate_product',$cate_product)->with('author_product',$author_product)->with('pbcompany_product',$pbcompany_product);
    }
    public function all_product(){
        $this->authlogin();
        $all_product=DB::table('tbl_sanpham')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_sanpham.category_id')
        ->join('tbl_author','tbl_author.author_id','=','tbl_sanpham.author_id')
        ->join('tbl_pbcompany','tbl_pbcompany.pbcompany_id','=','tbl_sanpham.pbcompany_id')
        ->orderby('tbl_sanpham.sanpham_id','desc')->get();
        $manager_product=view('admin.all_product')->with('all_product',$all_product);
        return view('admin-layout')->with('admin.all_product',$manager_product);
    }
    public function save_product(Request $request){
        $data=array();
        $data['sanpham_name']=$request->sanpham_name;
        $data['sanpham_price']=$request->sanpham_price;
        $data['sanpham_pbyear']=$request->sanpham_pbyear;
        $data['sanpham_desc']=$request->sanpham_desc;
        $data['sanpham_content']=$request->sanpham_content;
        $data['category_id']=$request->product_cate;
        $data['author_id']=$request->product_author;
        $data['pbcompany_id']=$request->product_pbcompany;
        $data['sanpham_status']=$request->sanpham_status;

        $get_image = $request->file('sanpham_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['sanpham_image'] = $new_image;
            DB::table('tbl_sanpham')->insert($data);
            session::put('message','thêm truyện thành công!');
            return Redirect::to('add-product');
        }
        $data['sanpham_image'] = '';
        DB::table('tbl_sanpham')->insert($data);
        session::put('message','thêm truyện thành công!');
        return Redirect::to('add-product');
    }
    public function unactive_product($product_id){
        DB::table('tbl_sanpham')->where('sanpham_id',$product_id)->update(['sanpham_status'=>1]);
        session::put('message','không kích hoạt truyện thành công!');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        DB::table('tbl_sanpham')->where('sanpham_id',$product_id)->update(['sanpham_status'=>0]);
        session::put('message','kích hoạt truyện thành công!');
        return Redirect::to('all-product');
    }
    public function edit_product($product_id){
        $this->authlogin();
        $cate_product=DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();
        $pbcompany_product=DB::table('tbl_pbcompany')->orderby('pbcompany_id','desc')->get();
        $edit_product=DB::table('tbl_sanpham')->where('sanpham_id',$product_id)->get();
        $manager_product=view('admin.edit_product')->with('edit_product',$edit_product)
        ->with('cate_product',$cate_product)
        ->with('author_product',$author_product)
        ->with('pbcompany_product',$pbcompany_product);
        return view('admin-layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request, $product_id){
        $data=array();
        $data['sanpham_name']=$request->sanpham_name;
        $data['sanpham_price']=$request->sanpham_price;
        $data['sanpham_pbyear']=$request->sanpham_pbyear;
        $data['sanpham_desc']=$request->sanpham_desc;
        $data['sanpham_content']=$request->sanpham_content;
        $data['category_id']=$request->product_cate;
        $data['author_id']=$request->product_author;
        $data['pbcompany_id']=$request->product_pbcompany;
        $data['sanpham_status']=$request->sanpham_status;
        $get_image = $request->file('sanpham_image');
        

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/upload/product',$new_image);
            $data['sanpham_image'] = $new_image;
            DB::table('tbl_sanpham')->where('sanpham_id',$product_id)->update($data);
            session::put('message','Cập nhật truyện thành công!');
            return Redirect::to('all-product');
        }
        
        DB::table('tbl_sanpham')->where('sanpham_id',$product_id)->update($data);
        session::put('message','Cập nhật truyện thành công!');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        DB::table('tbl_sanpham')->where('sanpham_id',$product_id)->delete();
        session::put('message','xoá truyện thành công!');
        return Redirect::to('all-product');
    }
    //end admin page
    public function details_product($product_id){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')
        ->orderby('category_id','desc')->get();
        
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();
        $details_product=DB::table('tbl_sanpham')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_sanpham.category_id')
        ->join('tbl_author','tbl_author.author_id','=','tbl_sanpham.author_id')
        ->join('tbl_pbcompany','tbl_pbcompany.pbcompany_id','=','tbl_sanpham.pbcompany_id')
        ->where('tbl_sanpham.sanpham_id',$product_id)->get();

        foreach($details_product as $key => $value){
            $category_id=$value->category_id;
        }

        $related_product=DB::table('tbl_sanpham')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_sanpham.category_id')
        ->join('tbl_author','tbl_author.author_id','=','tbl_sanpham.author_id')
        ->join('tbl_pbcompany','tbl_pbcompany.pbcompany_id','=','tbl_sanpham.pbcompany_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_sanpham.sanpham_id',[$product_id])->get();
        return view('pages.sanpham.show_details')->with('category',$cate_product)
        ->with('author',$author_product)->with('product_details',$details_product)
        ->with('relate',$related_product);
    }

}
