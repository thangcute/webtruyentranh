<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Cart;
use Illuminate\Support\Facades\Redirect;
session_start();

class CheckoutController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function view_order($orderId){
        $this->authlogin();
        $order_by_id=DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->join('tbl_shipping','tbl_order.shipping_id','=','tbl_shipping.shipping_id')
        ->join('tbl_order_details','tbl_order.order_id','=','tbl_order_details.order_id')
        ->where('tbl_order.order_id', $orderId)
        ->select('tbl_order.*','tbl_customer.*','tbl_shipping.*','tbl_order_details.*')->first();

        $manager_order_by_id=view('admin.view_order')->with('order_by_id',$order_by_id);
        return view('admin-layout')->with('admin.view_order',$manager_order_by_id);
    }
    public function delete_order($orderId){
        DB::table('tbl_order')->where('order_id',$orderId)->delete();
        session::put('message','xoá đơn hàng thành công!');
        $all_order=DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order=view('admin.manage_order')->with('all_order',$all_order);
        return view('admin-layout')->with('admin.manage_order',$manager_order);
    }
    public function login_checkout(){

        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        return view('pages.checkout.login_checkout')->with('category',$cate_product)->with('author',$author_product);
    }
    public function add_customer(Request $request){
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_phone'] = $request->customer_phone;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);

        $customer_id = DB::table('tbl_customer')->insertGetId($data);

        session::put('customer_id', $customer_id);
        session::put('customer_name',$request->customer_name);
        return Redirect('/checkout');
    }
    public function checkout(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        return view('pages.checkout.show_checkout')->with('category',$cate_product)->with('author',$author_product);
    }
    public function save_checkout_customer(Request $request){
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = DB::table('tbl_shipping')->insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        return Redirect('/payment');
    }
    public function payment(){
        $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
        $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

        return view('pages.checkout.payment')->with('category',$cate_product)->with('author',$author_product);
    }
    public function order_place(Request $request){
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ sử lí';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ sử lí';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //insert order_details
        $content = Cart::content();
        foreach($content as $v_content){
            $order_d_data['order_id'] = $order_id;
            $order_d_data['sanpham_id'] = $v_content->id;
            $order_d_data['sanpham_name'] = $v_content->name;
            $order_d_data['sanpham_price'] = $v_content->price;
            $order_d_data['sanpham_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }
        if($data['payment_method']==1){
            echo 'Thanh toán thẻ ATM';
        }elseif($data['payment_method']==2){
            Cart::destroy();
            $cate_product=DB::table('tbl_category_product')->where('category_status','0')->orderby('category_id','desc')->get();
            $author_product=DB::table('tbl_author')->orderby('author_id','desc')->get();

            return view('pages.checkout.handcash')->with('category',$cate_product)->with('author',$author_product);
        }else{
            echo 'Thẻ ghi nợ';
        }
        
        //return Redirect('/payment');
    }
    public function logout_checkout(){
        Session::flush();
        return Redirect('/login-checkout');
    }
    public function login_customer(Request $request){
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customer')->where('customer_email',$email)->where('customer_password',$password)->first();
        if($result){
            session::put('customer_id', $result->customer_id);
            return Redirect('/checkout');
        }else{
            return Redirect('/login-checkout');
        }
        
        
    }
    public function manage_order(){

        $this->authlogin();
        $all_order=DB::table('tbl_order')
        ->join('tbl_customer','tbl_order.customer_id','=','tbl_customer.customer_id')
        ->select('tbl_order.*','tbl_customer.customer_name')
        ->orderby('tbl_order.order_id','desc')->get();
        $manager_order=view('admin.manage_order')->with('all_order',$all_order);
        return view('admin-layout')->with('admin.manage_order',$manager_order);
    }
}
