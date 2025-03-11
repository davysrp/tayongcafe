<?php

namespace App\Http\Controllers;
use Intervention\Image\Facades\Image;
use App\Models\Category;
use App\Models\Product;
use App\Models\Webpage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Category::select('categories.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="'.$model->id.'" data-link="'.route('categories.destroy',$model->id).'" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('categories.edit',$model->id).'" type="button" class="btn btn-secondary" data-id="'.$model->id.'" id="edit" data-link="'.route('categories.edit',$model->id).'"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })
                ->editColumn('status',function ($model){
                    return $model->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.category.index');
    }




    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->data($request);


        if ($request->icon) {
            $destinationPath = public_path('storage');
            $photo = $request->file('icon');
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
            $data['icon'] = $imageFile;
        }
        $model = Category::create($data);
        return redirect()->back()-> with('success', 'Category Save successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Webpage $webpage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $model = Category::find($id);
        return view('backend.category.edit',compact('model'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $data = $this->data($request);
        $model = Category::find($id);
        if ($request->icon) {
            $destinationPath = public_path('storage');
            $photo = $request->file('icon');
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
            $data['icon'] = $imageFile;
        }
        $model->update($data);

        return redirect()->back()-> with('success', 'Category Save successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = Category::destroy($id);
        return response()->json([
            'success'=>true,
            'status'=>200,
            'message'=>'Category successful'
        ]);
    }
    public function data(Request $request)
    {
        $data = $this->validate($request, [
            'names' => 'required',
            'status' => 'nullable',
        ]);
        if ($request->status) $data['status'] = 1;
        if (!$request->status) $data['status'] = 0;
        return $data;

    }


    public function showNavbar()
    {
        $categories = Category::with('products')->where('status', 1)->get();
    
        // Debugging: Log the output
        Log::info($categories);
    
        return view('frontend.navbar', compact('categories'));
    }




}
