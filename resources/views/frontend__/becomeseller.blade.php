<x-app-layout>
    <?php
    $id = Auth::guard('seller')->user()->id;
    $seller = App\Models\Seller::find($id);

    ?>
    <div style="padding-top:50px;">
        <div class="container">
            <div class="post-product-container">
                <h1 style="text-align:center; font-size: 32px;">ក្លាយជាអ្នកលក់/Become Seller</h1>
                @if($errors->any())
                    <ul>
                        @foreach($errors->all() as $err)
                            <li>{{$err}}</li>
                        @endforeach
                    </ul>
                @endif
                {!! Form::open(['route' => ['frontend__.updatetoseller', $seller->id],'id'=>'seller_Form','method'=>'put','enctype' => 'multipart/form-data']) !!}

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('full_name','ឈ្មោះពេញ') !!}
                            {!! Form::text('full_name',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('gender',' ភេទ') !!}
                            {!! Form::select('gender',['m'=>'ប្រុស','f'=>'ស្រី','other'=>'ផ្សេង'],'m',['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            {!! Form::label('age','អាយុ') !!}
                            {!! Form::text('age',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        {!! Form::label('address','ទីលំនៅសព្វថ្ងៃ') !!}
                        {!! Form::text('address',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone','លេខទូរស័ព្ទ') !!}
                            {!! Form::text('phone',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            {!! Form::label('Telegram','Telegram') !!}
                            {!! Form::text('telegram',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">

                        <div class="form-group">
                            {!! Form::label('facebook','Facebook UID') !!}
                            {!! Form::text('facebook',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            {!! Form::label('facebook','អត្តសញ្ញាណប័ណ្ណ') !!}
                            {!! Form::file('id_card',['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            {!! Form::label('id_card_face','ថតកាន់អត្តសញ្ញាណប័ណ្ណ') !!}
                            {!! Form::file('id_card_face',['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            {!! Form::label('krqr_photo','គណនេយ្យធនាគា KHQR របស់អ្នក') !!}
                            {!! Form::file('krqr_photo',['class'=>'form-control']) !!}
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            {!! Form::label('product_type','តើផលិតផលអ្វីដែលអ្នកចង់ដាក់លក់?') !!}
                            {!! Form::text('product_type',null,['class'=>'form-control']) !!}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <p>លក្ខខណ្ឌ័ដើម្បីក្លាយជាអ្នកលក់</p><br>
                    </div>
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">ដាក់ស្នើរសុំ</button>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>



        <x-slot name="script">
            <script>
                $( "#seller_Form" ).validate( {
                    rules: {
                        full_name: "required",
                        gender: "required",
                        age: "required",
                        id_card: "required",
                        id_card_face: "required",
                        facebook: "required",
                        telegram: "required",
                        krqr_photo: "required",
                        product_type: "required",
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
