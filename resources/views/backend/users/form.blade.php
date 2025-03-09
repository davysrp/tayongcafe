<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::text('email', null, ['class' => 'form-control']) !!}
        </div>
    </div>

    @if(!isset($model))
    <div class="col">
        <div class="form-group">
            {!! Form::label('password') !!}
            {!! Form::text('password', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    @endif
</div>

<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>
    </div>
    
    <div class="col">
        <div class="form-group">
            {!! Form::label('photo', 'Profile Photo ') !!}
            {!! Form::file('photo', ['class' => 'form-control-file']) !!}
        </div>
    </div>
</div>

@if(isset($model) && $model->photo)
    <div class="row">
        <div class="col">
            <p>Current Profile Photo:</p>
            <img src="{{ asset('storage/' . $model->photo) }}" width="100" height="100" class="img-thumbnail">
        </div>
    </div>
@endif
