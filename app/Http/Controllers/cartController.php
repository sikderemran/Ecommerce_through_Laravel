<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Cart;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();

class cartController extends Controller
{
    public function add_to_cart(Request $request){
    	    $product_id=$request->product_id;
    	    $quentity=$request->quentity;
    		$product_info=DB::table('tbl_product')
    				  ->where('product_id',$product_id)
    				  ->first();
    		$data['qty']=$quentity;
    		$data['id']=$product_info->product_id;
    		$data['name']=$product_info->product_name;
    		$data['price']=$product_info->product_price;
    		$data['options']['image']=$product_info->product_image;
    		Cart::add($data);
    		return Redirect::to('/show_cart');
    }
    public function show_cart(){
    	$all_published_category=DB::table('tbl_category')
    							->where('publication_status',1)
    							->get();
		$manage_published_category=view('pages.add_to_cart')->with('all_published_category',$all_published_category);
    	return view('layout')->with('pages.add_to_cart',$manage_published_category);
    }
    public function delete_to_cart($rowId){
    	Cart::update($rowId,0);
    	return Redirect::to('/show_cart');
    }
    public function update_cart(Request $request ){
    	$qty=$request->quantity;
    	$rowId=$request->rowId;
    	Cart::update($rowId,$qty);
    	return Redirect::to('/show_cart');
    }
}
