<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function index(Request $request,$category=null)
    {
        $categories = Category::whereStatus(1)->get();

        $products = Product::whereStatus(1)
            ->where(function ($q) use($category){
                if ($category) $q->where('category_id', $category);
            })
            ->get();
        return view('frontend.index',compact('categories','products'));
    }
}
