<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class superAdminController extends Controller
{
	public function index(){
    	$this->adminAuth();
    	return view('admin.dashboard');
    }

    public function logout(){
    	Session::put('admin_name',null);
    	Session::put('admin_id',null);
    	return Redirect::to('/admin');
    }


    public function adminAuth(){
    	$admin_id=Session::get('admin_id');
    	if($admin_id){
    		return;
    	}else{
    		return Redirect::to('/admin')->send();
    	}
    }

}
