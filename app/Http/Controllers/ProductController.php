<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use Yajra\DataTables\DataTables;
use function Termwind\ValueObjects\p;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Product::select('products.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('products.destroy', $model->id) . '" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="' . route('products.edit', $model->id) . '"  class="btn btn-secondary" data-id="' . $model->id . '" id="edit" data-link="' . route('products.edit', $model->id) . '"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })
                ->editColumn('status', function ($model) {
                    return $model->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->escapeColumns([])
                ->make(true);
        }

        return view('backend.product.index');

    }

    public function create()
    {
        $category=Category::pluck('names','id');
        return view('backend.product.create',compact('category'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $destinationPath = public_path('uploads');
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

        $model = Product::create($data);

        if ($request->variant_code) {
            foreach ($request->variant_code as $key => $vCode) {
                ProductVariant::create([
                    'product_id' => $model->id,
                    'variant_code' => $vCode,
                    'variant_name' => $request->variant_name[$key],
                    'variant_price' => $request->variant_price[$key],
                    'status' => $request->variant_status[$key],
                    'variant_size' => $request->variant_size[$key]
                ]);
            }
        }
        return redirect()->back()->with('success', 'Product Save successfully');
    }

    public function edit($id)
    {
        $model = Product::with('productVariant')->find($id);
        $category=Category::pluck('names','id');
        return view('backend.product.edit', compact('model','category'));
    }

    public function update(Request $request, $id)
    {
        $model = Product::find($id);
        if ($model) {
            $data = $request->all();
            if ($request->photo) {
                $destinationPath = public_path('uploads');
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

            $model->update($data);

            if ($request->variant_code) {
                foreach ($request->variant_code as $key => $vCode) {

                    /*Find old*/
                    if (isset($request->variant_id[$key])) {
                        $findVariant = ProductVariant::find($request->variant_id[$key]);
                        if ($findVariant) {
                            $findVariant->update([
                                'variant_code' => $vCode,
                                'variant_name' => $request->variant_name[$key],
                                'variant_price' => $request->variant_price[$key],
                                'status' => $request->variant_status[$key],
                                'variant_size' => $request->variant_size[$key]
                            ]);
                        } else {
                            ProductVariant::create([
                                'product_id' => $model->id,
                                'variant_code' => $vCode,
                                'variant_name' => $request->variant_name[$key],
                                'variant_price' => $request->variant_price[$key],
                                'status' => $request->variant_status[$key],
                                'variant_size' => $request->variant_size[$key]
                            ]);
                        }
                    } else {
                        ProductVariant::create([
                            'product_id' => $model->id,
                            'variant_code' => $vCode,
                            'variant_name' => $request->variant_name[$key],
                            'variant_price' => $request->variant_price[$key],
                            'status' => $request->variant_status[$key],
                            'variant_size' => $request->variant_size[$key]
                        ]);
                    }


                }
            }


        }
        return redirect()->back()->with('success', 'Product Save successfully');

    }

    public function destroy($id)
    {
        $model = Product::find($id);
        if ($model) {
            $model->delete();
        }
        return response()->json([
            'success' => true,
        ]);
    }


}
