<?php

namespace App\Http\Controllers;

use App\Models\ProductPhoto;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductPhotoController extends Controller
{
   public function index()
   {
      $productphoto = DB::table('product_photos as prophoto')
      ->join('products as pro', 'pro.id', '=', 'prophoto.product_id')
      ->select('prophoto.*','pro.names as products_name')
      ->orderBy('prophoto.id','desc')
      ->paginate(3);
      $products = DB::table('products')->get();
      return view('backend.product.index', compact('productphoto','products'));
   }
}
