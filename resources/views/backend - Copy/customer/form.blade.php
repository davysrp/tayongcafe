<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('first_name') !!}
            {!! Form::text('first_name', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('last_name') !!}
            {!! Form::text('last_name', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('email') !!}
            {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('phone_number') !!}
            {!! Form::text('phone_number', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>