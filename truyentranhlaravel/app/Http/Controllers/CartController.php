<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Gloudemans\Shoppingcart\Facades\Cart;
session_start();

class CartController extends Controller
{
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        print_r($data);
    }
    public function save_cart(Request $request){
        
        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info=DB::table('tbl_sanpham')->where('sanpham_id',$productId)->first();

        

        //Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        
        $data['id'] = $product_info->sanpham_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->sanpham_name;
        $data['price'] = $product_info->sanpham_price;
        $data['weight'] = $product_info->sanpham_price;
        $data['options']['image'] = $product_info->sanpham_image;
        Cart::add($data);
        // Cart::destroy();
        return Redirect::to('/show-cart');

    }
    public function show_cart(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();
        return view('pages.Cart.show_cart')->with('category',$cate_product)->with('author',$author_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
}
