<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    public function authlogin(){
        $admin_id=session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        }else{
            return Redirect::to('Admin')->send();
        }
    }
    public function index(){
        return view('admin-login');
    }
    public function show_dashboard(){
        $this->authlogin();
        return view('admin.dashboard');
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = $request->admin_password;

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            return Redirect::to('/dashboard');
        }else{
            Session::put('message','Mật khẩu hoặc tài khoản sai.làm ơn nhập lại');
            return Redirect::to('/Admin');
        }
    }
    public function logout(){
        $this->authlogin();
        Session::put('admin_name',null);
        Session::put('admin_id',null);
        return Redirect::to('/Admin');
    }
}
