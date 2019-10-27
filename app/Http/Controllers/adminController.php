<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class adminController extends Controller
{
    public function index(){
        return view('adminLogin');

    }
    
    public function dashboard(Request $request){
    	$admin_email=$request->admin_email;
    	$admin_password=md5($request->admin_password);
    	$result=DB::table('tbl_admin')
    			->where('admin_email',$admin_email)
    			->where('admin_password',$admin_password)
    			->first();
    	if($result){
    		session::put('admin_name',$result->admin_name);
    		session::put('admin_id',$result->admin_id);
    		return Redirect::to('/dashboard');
    	}else{
    		session::put('message','email or password invalid');
    		return Redirect::to('/admin');
    	}

    }

}
