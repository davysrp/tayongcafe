{{-- 
<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('names', 'Page Name') !!}
            {!! Form::text('names', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            {!! Form::label('detail', 'Page Details') !!}
            {!! Form::textarea('detail', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            {!! Form::label('image', 'Upload Image') !!}
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>
    
        @if(isset($model) && $model->image)
            <img src="{{ Storage::url($model->image) }}" alt="Webpage Image" width="200">
        @else
            <p>No image available</p>
        @endif
    </div>
    
    
</div> --}}

<div class="row">
    <div class="col-md-12 mb-3">
        <label for="names" class="form-label fw-bold">Page Name</label>
        {!! Form::text('names', null, ['class' => 'form-control', 'placeholder' => 'Enter page name', 'required']) !!}
    </div>

    <div class="col-md-12 mb-3">
        <label for="detail" class="form-label fw-bold">Page Details</label>
        {!! Form::textarea('detail', null, ['class' => 'form-control', 'rows' => 5, 'placeholder' => 'Enter details', 'required']) !!}
    </div>
        
    <div class="col-12 mb-3">
        <label for="status" class="form-label fw-bold">Status</label>
        {!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], $model->status ?? 1, ['class' => 'form-control']) !!}
    </div>

    <div class="col-md-12 mb-4">
        <label for="image" class="form-label fw-bold">Upload Image</label>
        {!! Form::file('image', ['class' => 'form-control']) !!}
        
        @if(isset($model) && $model->image)
        <div class="mt-3">
            {{-- <img src="{{ Storage::url($model->image) }}" alt="Webpage Image" class="img-thumbnail" width="200"> --}}
            <img src="{{ Storage::url($model->image) }}" alt="Webpage Image" width="200">

        </div>

        

    @else
        <p class="text-muted mt-2">No image available</p>
    @endif
    
    </div>
</div>

