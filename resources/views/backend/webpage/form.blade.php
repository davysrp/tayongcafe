{{-- <div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('names') !!}
            {!! Form::text('names', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>

    <div class="col-12">
        {!! Form::label('detail') !!}
        {!! Form::textarea('detail', null, ['class' => 'form-control', 'required']) !!}
    </div>

    <div class="col-12">
        <div class="form-group">
            {!! Form::label('image', 'Upload Image') !!}
            {!! Form::file('image', ['class' => 'form-control']) !!}
        </div>

        @if(isset($model) && $model->image)
        <img src="{{ Storage::url($model->image) }}" alt="Webpage Image" width="100">
    @else
        <p>No image available</p>
    @endif
    


    </div>


</div> --}}
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
        {{ dd(Storage::url($model->image)) }}
        <img src="{{ Storage::url($model->image) }}" alt="Webpage Image" width="100">
    @else
        <p>No image available</p>
    @endif
    </div>
    
</div>
