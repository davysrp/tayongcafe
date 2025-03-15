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
            {{-- {!! Form::label('photo', 'Profile Photo (optional)') !!}
            {!! Form::file('photo', ['class' => 'form-control-file']) !!} --}}

            {!! Form::label('photo', 'Profile Photo (optional)') !!}
            {!! Form::file('photo', ['class' => 'form-control-file']) !!}
            

        </div>
    </div>
</div>

{{-- @if(isset($model) && $model->photo)
    <div class="row">
        <div class="col">
            <p>Current Profile Photo:</p>
            <img src="{{ asset('storage/' . $model->photo) }}" width="100" height="100" class="img-thumbnail">
        </div>
    </div>
@endif --}}


@if(isset($model) && $model->photo)
    <div class="row">
        <div class="col">
            <p>Current Profile Photo:</p>
            <img src="{{ asset('storage/' . $model->photo) }}" width="100" height="100" class="img-thumbnail">
        </div>
    </div>
@endif


<x-slot name="script">
    <script>
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