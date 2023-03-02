<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function index(){

        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        $all_product=DB::table('tbl_sanpham')->where('sanpham_status','0')->orderby('sanpham_id','desc')->limit(6)->get();
        return view('pages.home')->with('category',$cate_product)->with('author',$author_product)->with('all_product',$all_product);
    }
    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        $search_product=DB::table('tbl_sanpham')->where('sanpham_name','like','%'.$keywords.'%')->get();

        return view('pages.sanpham.search')->with('category',$cate_product)->with('author',$author_product)->with('search_product',$search_product);
    }
}
