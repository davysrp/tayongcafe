<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use App\Models\Seller;
use App\Models\Webpage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;

class WebpageController extends Controller
{


    // public function index(Request $request)
    // {
    //     if ($request->ajax()) {
    //         $model = Webpage::select('webpages.*');

    //         return DataTables::of($model)
    //             ->setRowAttr(['data-id' => fn($model) => $model->id])

    //             ->addColumn('image', function ($model) {
    //                 if ($model->image && Storage::exists('public/' . $model->image)) {
    //                     return '<img src="' . Storage::url($model->image) . '" width="50" class="img-thumbnail">';
    //                 }
    //                 return '<img src="' . asset('images/default.png') . '" width="50" class="img-thumbnail">';
    //             })

    //             ->editColumn('status', function ($model) {
    //                 return $model->status
    //                     ? '<span class="badge badge-success">Active</span>'
    //                     : '<span class="badge badge-danger">Inactive</span>';
    //             })

    //             // ->editColumn('status', function ($model) {
    //             //     return $model->status
    //             //         ? '<span class="badge badge-success">Active</span>'
    //             //         : '<span class="badge badge-danger">Inactive</span>';
    //             // })


    //             ->addColumn('action', function ($model) {
    //                 return '
    //                     <div class="btn-group btn-group-sm" role="group">
    //                         <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('web-pages.destroy', $model->id) . '" id="delete">
    //                             <i class="fas fa-trash-alt"></i>
    //                         </button>
    //                         <a href="' . route('web-pages.edit', $model->id) . '" class="btn btn-secondary">
    //                             <i class="fas fa-edit"></i>
    //                         </a>
    //                     </div>';
    //             })

    //             ->rawColumns(['image', 'status', 'action'])
    //             ->make(true);
    //     }

    //     return view('backend.webpage.index');
    // }

    // public function create()
    // {
    //     return view('backend.webpage.create');
    // }

    // public function store(Request $request)
    // {
    //     $validatedData = $request->validate([
    //         'names' => 'required|max:191',
    //         'detail' => 'required',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'status' => 'required|in:0,1',

    //     ]);

    //     // if ($request->hasFile('image')) {
    //     //     $validatedData['image'] = $request->file('image')->store('webpages', 'public');
    //     // }
    //      $destinationPath = public_path('webpages');

    //     if ($request->image) {
    //         $photo = $request->file('image');
    //         $newName = rand(100000, 999999) . date('YmdHis') . '.jpg';

    //         // Resize image as per your original logic
    //         $imgwidth = Image::make($photo->path())->getWidth();
    //         $imgHeigh = Image::make($photo->path())->getHeight();
    //         $percentOptm = 100 - (720 * 100 / $imgwidth);
    //         $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
    //         $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

    //         $imageFile = $newName . '.jpg';
    //         $img = Image::make($photo->path());
    //         $img->resize($width, $height, function ($constraint) {
    //             $constraint->aspectRatio();
    //             $constraint->upsize();
    //         })->save($destinationPath . '/' . $newName . '.jpg');

    //           $validatedData['image'] = $imageFile;
    //     }

    //     Webpage::create($validatedData);

    //     return redirect()->route('web-pages.index')->with('success', 'Web page created successfully.');
    // }

    // public function edit($id)
    // {
    //     $model = Webpage::findOrFail($id);
    //     return view('backend.webpage.edit', compact('model'));
    // }

    // public function update(Request $request, $id)
    // {
    //     $model = Webpage::findOrFail($id);
    //     $data = $request->validate([
    //         'names' => 'required',
    //         'detail' => 'required',
    //         'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    //         'status' => 'required|in:0,1',

    //     ]);

    //     // if ($request->hasFile('image')) {
    //     //     // Delete old image
    //     //     if ($model->image && Storage::exists('public/' . $model->image)) {
    //     //         Storage::delete('public/' . $model->image);
    //     //     }

    //     //     $data['image'] = $request->file('image')->store('webpages', 'public');
    //     // }


    //      $destinationPath =public_path('webpages');
    //       if ($request->image) {
    //             // Delete old photo if exists
    //             if ($model->image && File::exists($destinationPath . '/' . $model->image)) {
    //                 File::delete($destinationPath . '/' . $model->image);
    //             }

    //             // Handle new photo upload and resizing
    //             $photo = $request->file('image');
    //             $newName = rand(100000, 999999) . date('YmdHis'); // Keep original naming logic

    //             // Resize image using your original logic
    //             $imgwidth = Image::make($photo->path())->getWidth();
    //             $imgHeigh = Image::make($photo->path())->getHeight();
    //             $percentOptm = 100 - (720 * 100 / $imgwidth);
    //             $width = $imgwidth - (($imgwidth / 100) * $percentOptm);
    //             $height = $imgHeigh - (($imgHeigh / 100) * $percentOptm);

    //             $imageFile = $newName . '.jpg';
    //             $img = Image::make($photo->path());
    //             $img->resize($width, $height, function ($constraint) {
    //                 $constraint->aspectRatio();
    //                 $constraint->upsize();
    //             })->save($destinationPath . '/' . $newName . '.jpg');

    //             $data['photo'] = $imageFile;
    //         }

    //     $model->update($data);

    //     return redirect()->back()->with('success', 'Web page updated successfully');
    // }

    // public function destroy($id)
    // {
    //     $model = Webpage::find($id);

    //     if ($model) {
    //         // Delete image file
    //         if ($model->image && Storage::exists('public/' . $model->image)) {
    //             Storage::delete('public/' . $model->image);
    //         }

    //         $model->delete();
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'status' => 200,
    //         'message' => 'Web page deleted successfully'
    //     ]);
    // }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Webpage::select('webpages.*');

            return DataTables::of($model)
                ->addColumn('image', function ($model) {
                    if ($model->image && Storage::exists('public/' . $model->image)) {
                        return '<img src="' . asset('storage/' . $model->image) . '" width="50">';
                    }
                    return '<img src="' . asset('images/default.png') . '" width="50">';
                })
                ->editColumn('status', function ($model) {
                    return $model->status
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })
                ->addColumn('action', function ($model) {
                    return '
                        <div class="btn-group btn-group-sm">
                            <button class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('web-pages.destroy', $model->id) . '" id="delete">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <a href="' . route('web-pages.edit', $model->id) . '" class="btn btn-secondary">
                                <i class="fas fa-edit"></i>
                            </a>
                        </div>';
                })
                ->rawColumns(['image', 'status', 'action'])
                ->make(true);
        }

        return view('backend.webpage.index');
    }

    public function create()
    {
        return view('backend.webpage.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'names' => 'required|max:191',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            $validatedData['image'] = $request->file('image')->store('webpages', 'public');
        }

        Webpage::create($validatedData);

        return redirect()->route('web-pages.index')->with('success', 'Web page created successfully.');
    }

    public function edit($id)
    {
        $model = Webpage::findOrFail($id);
        return view('backend.webpage.edit', compact('model'));
    }

    public function update(Request $request, $id)
    {
        $model = Webpage::findOrFail($id);

        $data = $request->validate([
            'names' => 'required',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required|in:0,1',
        ]);

        if ($request->hasFile('image')) {
            if ($model->image && Storage::exists('public/' . $model->image)) {
                Storage::delete('public/' . $model->image);
            }

            $data['image'] = $request->file('image')->store('webpages', 'public');
        }

        $model->update($data);

        return redirect()->back()->with('success', 'Web page updated successfully');
    }

    public function destroy($id)
    {
        $model = Webpage::find($id);

        if ($model) {
            if ($model->image && Storage::exists('public/' . $model->image)) {
                Storage::delete('public/' . $model->image);
            }

            $model->delete();
        }

        return response()->json([
            'success' => true,
            'status' => 200,
            'message' => 'Web page deleted successfully',
        ]);
    }


}
