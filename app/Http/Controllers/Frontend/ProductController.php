<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductKey;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    protected $seller_id;

    public function __construct()
    {
        $this->seller_id = \Auth::guard('seller')->user();
    }

    //
    public function index(Request $request)
    {
        $seller = \Auth::guard('seller')->user();
        $products = Product::whereSellerId($seller->id)->paginate(20);
        return view('frontend__.seller.products.index', compact('products'));
    }

    public function create()
    {
        $category = Category::all();
        $photos = ProductPhoto::whereNull('product_id')->get();
        $product = null;
        return view('frontend__.seller.products.create', compact('category', 'photos', 'product'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $destinationPath = public_path('uploads');
        $seller = \Auth::guard('seller')->user();

//        if ($request->product_key_list) $product_key_list =  explode(',', $request->product_key_list);

      if ( $request->product_key_list)  $product_key_list = preg_split('/\r\n|[\r\n]/', $request->product_key_list);


        if ($request->photo) {
            $photo = $request->file('photo');
            $newName = rand(100000, 999999) . date('YmdHis');

            $imgwidth = Image::make($photo->path())->getWidth();
            $imgHeigh = Image::make($photo->path())->getHeight();
            $percentOptm = 100 - (720 * 100 / $imgwidth);
            $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
            $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

            $imageFile = $newName . '.jpg';
            $img = Image::make($photo->path());
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath . '/' . $newName . '.jpg');
            $data['photo'] = $imageFile;
        }
        $data['seller_id'] = $seller->id;
        $product = Product::create($data);

        if ($request->product_key) {
            foreach ($request->product_key as $key) {
                if ($key) {
                    ProductKey::create([
                        'product_id' => $product->id,
                        'product_key' => $key,
                        'status' => 1
                    ]);
                }

            }
        }

        if ($request->product_key_file) {
            $product_key_file = $request->file('product_key_file');

            $product_key_listFile = file($product_key_file->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($product_key_listFile as $key) {
                if ($key) {
                    ProductKey::create([
                        'product_id' => $product->id,
                        'product_key' => $key,
                        'status' => 1
                    ]);
                }

            }
        }

        if ($product_key_list) {
            foreach ($product_key_list as $key) {
                if ($key) {
                    ProductKey::create([
                        'product_id' => $product->id,
                        'product_key' => $key,
                        'status' => 1
                    ]);
                }

            }
        }


        if ($request->photos) {


            foreach ($request->photos as $photo) {
                $newName = rand(100000, 999999) . date('YmdHis');
                $ext = $photo->getClientOriginalExtension();
                $thumbnailImage = $newName . "." . $ext;
                $newName = rand(100000, 999999) . date('YmdHis');

                $imgwidth = Image::make($photo->path())->getWidth();
                $imgHeigh = Image::make($photo->path())->getHeight();
                $percentOptm = 100 - (720 * 100 / $imgwidth);
                $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
                $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

                $imageFile = $newName . '.jpg';
                $img = Image::make($photo->path());
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($destinationPath . '/' . $newName . '.jpg');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo' => $imageFile
                ]);
            }
        }
        return redirect()->back()->with('success', 'ផលិតផលបានផុសជោគជ័យ');
    }

    public function edit($id)
    {
        $category = Category::all();
        $product = Product::with(['productPhoto', 'productKey'])->find($id);
        return view('frontend__.seller.products.create', compact('category', 'product'));
    }

    public function update($id, Request $request)
    {
        $data = $request->all();
        $destinationPath = public_path('uploads');
        $seller = \Auth::guard('seller')->user();


        if ($request->photo) {
            $photo = $request->file('photo');
            $newName = rand(100000, 999999) . date('YmdHis');

            $imgwidth = Image::make($photo->path())->getWidth();
            $imgHeigh = Image::make($photo->path())->getHeight();
            $percentOptm = 100 - (720 * 100 / $imgwidth);
            $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
            $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

            $imageFile = $newName . '.jpg';
            $img = Image::make($photo->path());
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            })->save($destinationPath . '/' . $newName . '.jpg');
            $data['photo'] = $imageFile;
        }
        $data['seller_id'] = $seller->id;
        $product = Product::find($id);
        $product->update($data);
        if ($request->product_key) {
            foreach ($request->product_key as $key) {
                ProductKey::create([
                    'product_id' => $product->id,
                    'product_key' => $key,
                    'status' => 1
                ]);
            }
        }

        if ($request->photos) {
            foreach ($request->photos as $photo) {
                $newName = rand(100000, 999999) . date('YmdHis');
                $ext = $photo->getClientOriginalExtension();
                $thumbnailImage = $newName . "." . $ext;
                $newName = rand(100000, 999999) . date('YmdHis');

                $imgwidth = Image::make($photo->path())->getWidth();
                $imgHeigh = Image::make($photo->path())->getHeight();
                $percentOptm = 100 - (720 * 100 / $imgwidth);
                $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
                $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

                $imageFile = $newName . '.jpg';
                $img = Image::make($photo->path());
                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($destinationPath . '/' . $newName . '.jpg');
                ProductPhoto::create([
                    'product_id' => $product->id,
                    'photo' => $imageFile
                ]);
            }
        }

        if ( $request->product_key_list)  $product_key_list = preg_split('/\r\n|[\r\n]/', $request->product_key_list);

        if ($request->product_key) {
            foreach ($request->product_key as $key) {
                if ($key) {
                    ProductKey::create([
                        'product_id' => $product->id,
                        'product_key' => $key,
                        'status' => 1
                    ]);
                }

            }
        }

        if ($request->product_key_file) {
            $product_key_file = $request->file('product_key_file');

            $product_key_listFile = file($product_key_file->getRealPath(), FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($product_key_listFile as $key) {
                if ($key) {
                    ProductKey::create([
                        'product_id' => $product->id,
                        'product_key' => $key,
                        'status' => 1
                    ]);
                }

            }
        }

        if ($product_key_list) {
            foreach ($product_key_list as $key) {
                if ($key) {
                    ProductKey::create([
                        'product_id' => $product->id,
                        'product_key' => $key,
                        'status' => 1
                    ]);
                }

            }
        }

        return redirect()->back()->with('success', 'ផលិតផលបានផុសជោគជ័យ');
    }
}
