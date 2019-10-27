<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class categoryController extends Controller
{
    public function index(){
        $this->adminAuth();
    	return view('admin.addCategory');
    }
    public function allCategory(){
        $this->adminAuth();
    	$all_category_info=DB::table('tbl_category')->get();
    	$manage_category=view('admin.allCategory')->with('all_category_info',$all_category_info);
    	return view('adminLayout')->with('admin.allCategory',$manage_category);
    }
    public function saveCategory(Request $request){
        $this->adminAuth();
    	$data=array();
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	$data['publication_status']=$request->publication_status;
    	DB::table('tbl_category')->insert($data);
    	Session::put('message','Category Insert Successfully');
    	return Redirect::to('/addCategory');
    }
    public function unactive_category($category_id){
        $this->adminAuth();
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['publication_status'=>0]);
    	return Redirect::to('/allCategory');	
    }
    public function active_category($category_id){
        $this->adminAuth();
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update(['publication_status'=>1]);
    	return Redirect::to('/allCategory');	
    }
    public function edit_category($category_id){
             $this->adminAuth();
    		$all_category_info=DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->first();
    		$manage_category=view('admin.edit_category')->with('all_category_info',$all_category_info);
    		return view('adminLayout')->with('admin.edit_category',$manage_category);
    }
    public function update_category(Request $request,$category_id){
        $this->adminAuth();
    	$data=array();
    	$data['category_name']=$request->category_name;
    	$data['category_description']=$request->category_description;
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->update($data);
    	return Redirect::to('/allCategory');
    }
    public function delete_category($category_id){
        $this->adminAuth();
    	DB::table('tbl_category')
    		->where('category_id',$category_id)
    		->delete();
    	return Redirect::to('/allCategory');
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
