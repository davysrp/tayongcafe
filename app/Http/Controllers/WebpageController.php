<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;

use App\Models\Seller;
use App\Models\Webpage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


class WebpageController extends Controller
{
    
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Webpage::select('webpages.*');

            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                // ->addColumn('image', function ($model) {
                //     // return '<img src="'.asset('storage/'.$model->image).'" width="50">';
                //     return '<img src="'.asset('storage/'.$model->image).'" width="50">';

                // })

                ->addColumn('image', function ($model) {
                    if ($model->image && Storage::exists('public/' . $model->image)) {
                        return '<img src="' . Storage::url($model->image) . '" width="50">';
                    }
                    return '<img src="' . asset('default.png') . '" width="50">'; // Default image if missing
                })
                
                ->editColumn('status', function ($model) {
                    return $model->status
                        ? '<span class="badge badge-success">Active</span>'
                        : '<span class="badge badge-danger">Inactive</span>';
                })

                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="' . $model->id . '" data-link="' . route('web-pages.destroy', $model->id) . '" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="' . route('web-pages.edit', $model->id) . '"  class="btn btn-secondary" data-id="' . $model->id . '" id="edit" data-link="' . route('web-pages.edit', $model->id) . '"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })

                ->rawColumns(['image', 'status', 'action']) // Allow HTML in these columns
                ->make(true);
        }

        return view('backend.webpage.index');
    }

    public function create()
    {
        return view('backend.webpage.create');
    }

    // public function store(Request $request)
    // {
    //     $data = $this->data($request);

    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->store('webpages', 'public');
    //         $data['image'] = $imagePath;
    //     }

    //     Webpage::create($data);

    //     return redirect()->back()->with('success', 'Web page saved successfully');
    // }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'names' => 'required|max:191',
            'detail' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('webpages', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        WebPage::create($validatedData);
    
        return redirect()->route('web-pages.index')->with('success', 'Web page created successfully.');
    }

    public function show(Webpage $webpage)
    {
        //
    }

    public function edit($id)
    {
        $model = Webpage::find($id);
        return view('backend.webpage.edit',compact('model'));
    }

    public function update(Request $request, $id)
    {
        $data = $this->data($request);
        $model = Webpage::find($id);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($model->image) {
                \Storage::delete('public/' . $model->image);
            }
            $imagePath = $request->file('image')->store('webpages', 'public');
            $data['image'] = $imagePath;
        }

        $model->update($data);

        return redirect()->back()->with('success', 'Web page updated successfully');
    }

    public function destroy($id)
    {
        $model = Webpage::destroy($id);
        return response()->json([
            'success'=>true,
            'status'=>200,
            'message'=>'Web delete successful'
        ]);
    }
    public function data(Request $request)
    {
        return $request->validate([
            'names' => 'required',  // Name of the webpage (was detail_upper)
            'detail' => 'required', // Details of the webpage (was detail_middle)
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Image of the webpage
        ]);
    }

}


