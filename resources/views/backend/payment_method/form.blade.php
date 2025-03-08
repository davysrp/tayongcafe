{{-- <div class="row">
    <div class="col">
        <div
            class="form-group">{!! Form::label('names').  Form::text('names',null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('status') !!}
            {!!  Form::select('status',['active'=>'Active','inactive'=>'Inactive'],null,['class'=>'form-control','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div
            class="form-group">{!! Form::label('token').  Form::text('token',null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div
            class="form-group"> {!! Form::label('token_expired').  Form::text('token_expired',null,['class'=>'form-control']) !!}</div>
    </div>

</div> --}}


{{-- <div class="row">
    <div class="col">
        <div
            class="form-group">{!! Form::label('names').  Form::text('names',null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('status') !!}
            {!!  Form::select('status',['active'=>'Active','inactive'=>'Inactive'],null,['class'=>'form-control','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div
            class="form-group">{!! Form::label('token').  Form::text('token',null,['class'=>'form-control','required']) !!}</div>
    </div>
</div> --}}

<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('names') !!} 
            {!! Form::text('names',null,['class'=>'form-control','required']) !!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('status') !!}
            {!! Form::select('status',['active'=>'Active','inactive'=>'Inactive'],null,['class'=>'form-control status-label','required']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('token') !!}
            {!! Form::text('token',null,['class'=>'form-control','required']) !!}
        </div>
    </div>
</div>