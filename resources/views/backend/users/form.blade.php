<div class="row">
    <div class="col">
        <div class="form-group"> {!! Form::label('email').  Form::text('email',null,['class'=>'form-control']) !!}</div>
    </div>
    @if(!isset($model))
    <div class="col">
        <div class="form-group"> {!! Form::label('password').  Form::text('password',null,['class'=>'form-control']) !!}</div>
    </div>
        @endif
</div>
<div class="row">
    <div class="col">
        <div class="form-group">{!! Form::label('name').  Form::text('name',null,['class'=>'form-control']) !!}</div>
    </div>
    <div class="col"></div>
</div>
