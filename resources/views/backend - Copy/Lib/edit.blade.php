
{!! Form::model($model, [ 'route' => [$route, $model->id], 'method' =>$method?? 'put','enctype'=>'multipart/form-data' ,'files'=>true]) !!}

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">{!! $title ?? null !!}</h6>
    </div>
    <div class="card-body">
        @if(isset($form))
            @include($form)
        @endif
        <button type="reset" class="btn btn-secondary">Reset</button>
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</div>

{!! \Form::close() !!}
