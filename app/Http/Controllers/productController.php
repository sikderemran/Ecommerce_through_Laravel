<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class productController extends Controller
{
    public function add_product(){
        $this->adminAuth();
    	return view('admin.add_product');
    }
    public function all_product(){
        $this->adminAuth();
        $all_product_info=DB::table('tbl_product')
                           ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                           ->join('manufacture','tbl_product.manufacture_id','=','manufacture.manufacture_id')
                           ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
                          ->get();
        $manage_product=view('admin.all_product')->with('all_product_info',$all_product_info);
        return view('adminLayout')->with('admin.all_product',$manage_product);
    }
    public function unactive_product($product_id){
        $this->adminAuth();
        DB::table('tbl_product')
            ->where('product_id',$product_id)
            ->update(['publication_status'=>0]);
        return Redirect::to('/all_product');    
    }
    public function active_product($product_id){
        $this->adminAuth();
        DB::table('tbl_product')
            ->where('product_id',$product_id)
            ->update(['publication_status'=>1]);
        return Redirect::to('/all_product');    
    }
    public function delete_product($product_id){
        $this->adminAuth();
        DB::table('tbl_product')
            ->where('product_id',$product_id)
            ->delete();
        return Redirect::to('/all_product');
    }
    public function edit_product($product_id){
        $this->adminAuth();
            $all_product_info=DB::table('tbl_product')
            ->where('product_id',$product_id)
            ->first();
            $manage_product=view('admin.edit_product')->with('all_product_info',$all_product_info);
            return view('adminLayout')->with('admin.edit_product',$manage_product);
    }
    public function update_product(Request $request,$product_id){
        $this->adminAuth();
        $data=array();
        $data['product_name']=$request->product_name;
        $image=$request->file('product_image');
        $data['product_color']=$request->product_color;
        $data['product_size']=$request->product_size;
        $data['product_price']=$request->product_price;
        $data['category_id']=$request->category_id;
        $data['manufacture_id']=$request->manufacture_id;
        $data['product_short_description']=$request->product_short_description;
        $data['product_long_description']=$request->product_long_description;
        $data['publication_status']=$request->publication_status;
        if($image){
            $image_name=str_random(20);
            $text=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$text;
            $upload_path='image/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            if($success){
                $data['product_image']=$image_url;
                DB::table('tbl_product')
                        ->where('product_id',$product_id)
                        ->update($data);
                Session::put('message','product insert successefully');
                return Redirect::to('/add_product');

            }else{
                $data['product_image']='';
                DB::table('tbl_product')
                    ->where('product_id',$product_id)
                    ->update($data);
                Session::put('message','product insert successefully');
                return Redirect::to('/add_product');
            }

        }
    }
    public function save_product(Request $request){
        $this->adminAuth();
    	$data=array();
    	$data['product_name']=$request->product_name;
    	$image=$request->file('product_image');
    	$data['product_color']=$request->product_color;
    	$data['product_size']=$request->product_size;
    	$data['product_price']=$request->product_price;
    	$data['category_id']=$request->category_id;
    	$data['manufacture_id']=$request->manufacture_id;
    	$data['product_short_description']=$request->product_short_description;
    	$data['product_long_description']=$request->product_long_description;
    	$data['publication_status']=$request->publication_status;
    	if($image){
    		$image_name=str_random(20);
    		$text=strtolower($image->getClientOriginalExtension());
    		$image_full_name=$image_name.'.'.$text;
    		$upload_path='image/';
    		$image_url=$upload_path.$image_full_name;
    		$success=$image->move($upload_path,$image_full_name);
    		if($success){
    			$data['product_image']=$image_url;
    			DB::table('tbl_product')
    			         ->insert($data);
    			Session::put('message','product insert successefully');
    			return Redirect::to('/add_product');

    		}else{
    			$data['product_image']='';
    			DB::table('tbl_product')
    			         ->insert($data);
    			Session::put('message','product insert successefully');
    			return Redirect::to('/add_product');
    		}

    	}
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
