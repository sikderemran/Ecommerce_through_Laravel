<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class brandController extends Controller
{
    public function addBrand(){
        return view('admin.addBrand');
    }
    public function saveBrand(Request $request){
    	
    	$brandName=$request->brand_name;
    	$brandDescription=$request->brand_description;
    	$publicationStatus=$request->publication_status;
    	$data = array();
    
    	$data['manufacture_name']=$brandName;
    	$data['manufacture_description']=$brandDescription;
    	$data['publication_status']=$publicationStatus;
    	DB::table('manufacture')
    			->insert($data);
    	Session::put('message','insert successfully');
    	return Redirect::to('/addBrand');
    }
    public function allBrand(){
    	$all_brand_info=DB::table('manufacture')->get();
    	$manage_brand=view('admin.allBrand')->with('all_brand_info',$all_brand_info);
    	return view('adminLayout')->with('admin.allBrand',$manage_brand);
    }
    public function deactive_brand($manufacture_id){
        DB::table('manufacture')
                         ->where('manufacture_id',$manufacture_id)
                         ->update(['publication_status'=>0]);
        return Redirect::to('/allBrand');   
    }
    public function active_brand($manufacture_id){
        DB::table('manufacture')
                  ->where('manufacture_id',$manufacture_id)
                  ->update(['publication_status'=>1]);
        return Redirect::to('/allBrand');
    }
    public function delete_brand($manufacture_id){
        DB::table('manufacture')
                 ->where('manufacture_id',$manufacture_id)
                 ->delete();
        return Redirect::to('/allBrand');
    }
    public function edit_brand($manufacture_id){
        $edit_brand_info=DB::table('manufacture')
                         ->where('manufacture_id',$manufacture_id)
                         ->first();
        $manage_brand=view('admin.edit_brand')->with('edit_brand_info',$edit_brand_info);
        return view('adminLayout')->with('admin.edit_brand',$manage_brand);
    }
    public function update_brand(Request $request,$manufacture_id){
        $data=array();
        $data['manufacture_name']=$request->category_name;
        $data['manufacture_description']=$request->category_description;
        DB::table('manufacture')
                  ->where('manufacture_id',$manufacture_id)
                  ->update($data);
        return Redirect::to('/allBrand');
    }
}
