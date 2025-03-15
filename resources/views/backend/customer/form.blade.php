{{-- <div class="row">
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
</div> --}}


{{-- 
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
            {!! Form::email('email', old('email', $model->email), ['class' => 'form-control', 'required', 'id' => 'email']) !!}
    
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

<x-slot name="script">
    <script>
        $(document).ready(function () {
            // Allow only numbers and '+' at the start
            $(document).on('input', 'input[name="phone_number"]', function () {
                this.value = this.value.replace(/[^0-9+]/g, ''); // Allow only numbers and '+'
                if (this.value.length > 0 && this.value[0] !== '+') {
                    this.value = '+' + this.value.replace(/\+/g, ''); // Ensure '+' is at the start
                }
            });

            // Restrict email input to prevent typing after "@gmail.com"
            $('#email').on('input', function () {
                let value = $(this).val();
                let match = value.match(/^([^@]*)@gmail\.com$/);

                if (match) {
                    $(this).val(match[0]); // Keep only "@gmail.com"
                } else {
                    let parts = value.split('@');
                    if (parts.length > 1) {
                        $(this).val(parts[0] + '@gmail.com'); // Force "@gmail.com"
                    }
                }
            });

            // Auto-hide the email error when user starts typing again
            $('#email').on('input', function () {
                $('#email-error').fadeOut();
            });

        });

        $(document).ready(function () {
            // Hide error only if email is actually changed
            $('#email').on('input', function () {
                let originalEmail = "{{ $model->email }}"; // Get original email
                let currentEmail = $(this).val();
                
                if (currentEmail !== originalEmail) {
                    $('#email-error').fadeOut();
                }
            });
        });

    </script>
</x-slot> --}}


{{-- 
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

            <!-- Show Duplicate Email Error Below Email Field -->
            @if (!empty($errorMessage))
                <span class="text-danger" id="email-error">{{ $errorMessage }}</span>
            @endif
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

<x-slot name="script">
    <script>
        $(document).ready(function () {
            // Allow only numbers and '+' at the start
            $(document).on('input', 'input[name="phone_number"]', function () {
                this.value = this.value.replace(/[^0-9+]/g, ''); // Allow only numbers and '+'
                if (this.value.length > 0 && this.value[0] !== '+') {
                    this.value = '+' + this.value.replace(/\+/g, ''); // Ensure '+' is at the start
                }
            });

            // Restrict email input to prevent typing after "@gmail.com"
            $('#email').on('input', function () {
                let value = $(this).val();
                let match = value.match(/^([^@]*)@gmail\.com$/);

                if (match) {
                    $(this).val(match[0]); // Keep only "@gmail.com"
                } else {
                    let parts = value.split('@');
                    if (parts.length > 1) {
                        $(this).val(parts[0] + '@gmail.com'); // Force "@gmail.com"
                    }
                }
            });

            // Hide error only if email is actually changed
            let originalEmail = "{{ isset($model) ? $model->email : '' }}"; // Avoid undefined error

            $('#email').on('input', function () {
                let currentEmail = $(this).val();
                
                if (currentEmail !== originalEmail) {
                    $('#email-error').fadeOut();
                }
            });
        });
    </script>
</x-slot> --}}


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
