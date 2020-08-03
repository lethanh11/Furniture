<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function index(){
        return view('admin_login');
    }

    public function show_dashboard(){
        return view('admin.dashboard');
    }

    public function dashboard(Request $request){
        $admin_email = $request->email;
        $admin_password = $request->password;

        $result = DB::table('admin')->where('email',$admin_email)->where('password',$admin_password)->first();


        //kiểm tra xem tài khoản mật khẩu đúng không
        if($result==true){
            Session::put('name',$result->name);
            Session::put('id',$result->id);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message','Tài Khoản hoặc Mật Khẩu không đúng');
            return Redirect::to('/admin');
        }
    }

    public function logout(){
        Session::put('name',null);
        Session::put('id',null);

        return Redirect::to('/admin');
    }
}
