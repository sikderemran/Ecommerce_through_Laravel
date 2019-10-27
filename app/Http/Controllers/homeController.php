<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Session;
session_start();
class homeController extends Controller
{
    public function index(){
    	$all_product_info=DB::table('tbl_product')
                           ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                           ->join('manufacture','tbl_product.manufacture_id','=','manufacture.manufacture_id')
                           ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
                           ->limit(6)
                          ->get();
        $manage_product=view('pages.homeContent')->with('all_product_info',$all_product_info);
        return view('layout')->with('pages.homeContent',$manage_product);
    }
    public function product_by_category($category_id){
      $product_by_category=DB::table('tbl_product')
                           ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                           ->select('tbl_product.*','tbl_category.category_name')
                           ->where('tbl_category.category_id',$category_id)
                           ->limit(6)
                          ->get();
        $manage_category=view('pages.category_by_products')->with('product_by_category',$product_by_category);
        return view('layout')->with('pages.category_by_products',$manage_category);
    }
    public function product_by_manufacture($brand_id){
      $product_by_manufacture=DB::table('tbl_product')
                           ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                           ->join('manufacture','tbl_product.manufacture_id','=','manufacture.manufacture_id')
                           ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
                           ->where('tbl_product.manufacture_id',$brand_id)
                           ->limit(6)
                          ->get();
        $manage_manufacture=view('pages.manufacture_by_products')->with('product_by_manufacture',$product_by_manufacture);
        return view('layout')->with('pages.manufacture_by_products',$manage_manufacture);
    }
    public function product_details($product_id){
        $product_by_details=DB::table('tbl_product')
                           ->join('tbl_category','tbl_product.category_id','=','tbl_category.category_id')
                           ->join('manufacture','tbl_product.manufacture_id','=','manufacture.manufacture_id')
                           ->select('tbl_product.*','tbl_category.category_name','manufacture.manufacture_name')
                           ->where('tbl_product.product_id',$product_id)
                          ->first();
        $manage_product_by_details=view('pages.product_details')->with('product_by_details',$product_by_details);
        return view('layout')->with('pages.product_details',$manage_product_by_details);
    }

}
