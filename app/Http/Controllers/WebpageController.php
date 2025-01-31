<?php

namespace App\Http\Controllers;

use App\Models\Seller;
use App\Models\Webpage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class WebpageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Webpage::select('webpages.*');
            return DataTables::of($model)
                ->setRowAttr(['data-id' => function ($model) {
                    return $model->id;
                }])
                ->addColumn('action', function ($model) {
                    $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                              <button type="button" class="btn btn-danger" data-id="'.$model->id.'" data-link="'.route('web-pages.destroy',$model->id).'" id="delete"><i class="fas fa-trash-alt"></i></button>
                              <a href="'.route('web-pages.edit',$model->id).'" type="button" class="btn btn-secondary" data-id="'.$model->id.'" id="edit" data-link="'.route('web-pages.edit',$model->id).'"><i class="fas fa-edit"></i></a>
                            </div>';
                    return $html;
                })
                ->editColumn('status',function ($model){
                    return $model->status ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Inactive</span>';
                })
                ->escapeColumns([])
                ->make(true);
        }
        return view('backend.webpage.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.webpage.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $this->data($request);
        $model = Webpage::create($data);
        return redirect()->back()-> with('success', 'Web page Save successfully');
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
        $model = Webpage::find($id);
        return view('backend.webpage.edit',compact('model'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $this->data($request);
        $model = Webpage::find($id);
        $model->update($data);
        return redirect()->back()-> with('success', 'Category Save successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
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
        $data = $this->validate($request, [
            'names' => 'required',
            'detail' => 'required',
        ]);
        return $data;

    }
}
