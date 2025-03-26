@if(!isset($model))
<form id="customer_form" action="{{ route('customers.store') }}" method="POST">

<div class="row">
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('first_name', 'First Name') !!}
            {!! Form::text('first_name', old('first_name'), ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('last_name', 'Last Name') !!}
            {!! Form::text('last_name', old('last_name'), ['class' => 'form-control', 'required']) !!}
        </div>
    </div>

    <div class="col-12">
        <div class="form-group">
            {!! Form::label('email', 'Email') !!}
            {!! Form::email('email', old('email'), ['class' => 'form-control', 'required', 'id' => 'email']) !!}
    
            <!-- Show Duplicate Email Error Below Email Field -->
            @if (session('error'))
                <span class="text-danger" id="email-error">{{ session('error') }}</span>
            @endif
        </div>
    </div>
    
    
    <div class="col-12">
        <div class="form-group">
            {!! Form::label('phone_number', 'Phone Number') !!}
            {!! Form::tel('phone_number', old('phone_number'), [
                'class' => 'form-control',
                'pattern' => '^\+?[0-9]{10,15}$',
                'title' => 'Enter a valid phone number (e.g., +855123456789)',
                'required'
            ]) !!}
        </div>
    </div>
</div>
</form>
@endif

@if(isset($model))
<form id="customer_form" action="{{ route('customers.update', $model->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="row">
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('first_name', 'First Name') !!}
                {!! Form::text('first_name', old('first_name', isset($model) ? $model->first_name : ''), ['class' => 'form-control', 'required']) !!}
            </div>
        </div>
        <div class="col-12">
            <div class="form-group">
                {!! Form::label('last_name', 'Last Name') !!}
                {!! Form::text('last_name', old('last_name', isset($model) ? $model->last_name : ''), ['class' => 'form-control', 'required']) !!}
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                {!! Form::label('email', 'Email') !!}
                {!! Form::email('email', old('email', isset($model) ? $model->email : ''), ['class' => 'form-control', 'required', 'id' => 'email']) !!}
            </div>
        </div>

        <div class="col-12">
            <div class="form-group">
                {!! Form::label('phone_number', 'Phone Number') !!}
                {!! Form::tel('phone_number', old('phone_number', isset($model) ? $model->phone_number : ''), [
                    'class' => 'form-control',
                    'pattern' => '^\+?[0-9]{10,15}$',
                    'title' => 'Enter a valid phone number (e.g., +855123456789)',
                    'required'
                ]) !!}
            </div>
        </div>
    </div>

    <button type="reset" class="btn btn-secondary">Reset</button>
    <button type="submit" class="btn btn-primary">Save</button>
</form>
@endif
<x-slot name="script">
    <script>
        $(document).ready(function () {
            $("#customer_form").on("submit", function (event) {
                event.preventDefault(); // Prevent default form submission
                
                let form = $(this);
                let formData = form.serialize();

                $.ajax({
                    url: form.attr("action"),
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        if (response.success) {
                            Swal.fire({
                                icon: "success",
                                title: "Success",
                                text: response.message,
                            }).then(() => {
                                location.reload(); // Reload page after success
                            });
                        }
                    },
                    error: function (xhr) {
                        let response = xhr.responseJSON;
                        if (response && response.message) {
                            Swal.fire({
                                icon: "error",
                                title: "Duplicate Email",
                                text: response.message,
                            });
                        }
                    }
                });
            });
        });
    </script>
</x-slot>
