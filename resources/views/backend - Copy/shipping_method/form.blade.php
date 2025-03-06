<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', ['active' => 'Active', 'inactive' => 'Inactive'], null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>
