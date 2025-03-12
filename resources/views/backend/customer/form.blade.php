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
            {!! Form::tel('phone_number', null, [
                'class' => 'form-control',
                'pattern' => '^\+?[0-9]{10,15}$',
                'title' => 'Enter a valid phone number (e.g., +855123456789)',
                #'placeholder' => '+855123456789',
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
        });

        $(document).ready(function () {
            // Restrict email input to prevent typing after "@gmail.com"
            $('#email').on('input', function () {
                let value = $(this).val();
                let match = value.match(/^([^@]*)@gmail\.com$/);

                if (match) {
                    // If the email contains "@gmail.com", lock the input to prevent more typing
                    $(this).val(match[0]); // Keep only "@gmail.com" and block extra input
                } else {
                    // If @gmail.com is not typed yet, allow input normally
                    let parts = value.split('@');
                    if (parts.length > 1) {
                        $(this).val(parts[0] + '@gmail.com'); // Force "@gmail.com"
                    }
                }
            });
        });


    </script>
</x-slot>
