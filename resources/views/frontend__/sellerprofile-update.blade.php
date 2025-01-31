<x-app-layout>
    <?php
    $id = Auth::guard('seller')->user()->id;
    $seller = App\Models\Seller::find($id);
    ?>

    <div class="container">
        <div class="post-product-container">
            {!! Form::model($seller, ['route' => ['frontend__.sellerprofileSaveupdate', $seller->id],'method'=>'PUT','id'=>'profileForm']) !!}
            <h1 style="text-align:center; font-size: 32px;">Update Information</h1>
            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $err)
                        <li>{{$err}}</li>
                    @endforeach
                </ul>
            @endif
            <div class="row justify-content-center">

                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('full_name') !!}
                        {!! Form::text('full_name',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('phone') !!}
                        {!! Form::text('phone',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('email') !!}
                        {!! Form::text('email',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('facebook') !!}
                        {!! Form::text('facebook',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::label('telegram') !!}
                        {!! Form::text('telegram',null,['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="form-group">
                        {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>


        <x-slot name="script">
            <script>
                $( "#profileForm" ).validate( {
                    rules: {
                        full_name: "required",
                        gender: "required",
                        age: "required",
                        facebook: "required",
                        telegram: "required",
                        phone: "required",
                        address: "required",
                    },
                    /*messages: {
                        names: "Please enter your name",
                        detail: "Please enter your content detail",
                        category_id: "Please select category",
                        product_number: "Please enter number of product",
                    },*/
                    errorElement: "em",
                    errorPlacement: function ( error, element ) {
                        // Add the `invalid-feedback` class to the error element
                        error.addClass( "invalid-feedback" );

                        if ( element.prop( "type" ) === "checkbox" ) {
                            error.insertAfter( element.next( "label" ) );
                        } else {
                            error.insertAfter( element );
                        }
                    },
                    highlight: function ( element, errorClass, validClass ) {
                        $( element ).addClass( "is-invalid" ).removeClass( "is-valid" );
                    },
                    unhighlight: function (element, errorClass, validClass) {
                        $( element ).addClass( "is-valid" ).removeClass( "is-invalid" );
                    }
                } );

            </script>
        </x-slot>
</x-app-layout>
