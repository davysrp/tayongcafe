<x-app-layout>


    <div class="container">
        <div class="post-product-container">

            @if(Session::get('success'))
                <div class="alert alert-primary" role="alert">
                    {!! Session::get('success') !!}
                </div>
            @endif
            <div class="row">

                @if($product)
                    {!! Form::model($product, ['route' => ['seller-products.update', $product->id],'method'=>'PUT','enctype'=>'multipart/form-data','id'=>'productForm']) !!}
                @else
                    {!! Form::open(['route'=>'seller-products.store','enctype'=>'multipart/form-data','id'=>'productForm']) !!}
                @endif

                <div class="form-group">
                    @foreach($category as $catItem)
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="category_id"
                                   id="inlineRadio{!! $catItem->id !!}" value="{!! $catItem->id !!}"
                                   @if($product && $product->category_id==$catItem->id) checked @endif >
                            <label class="form-check-label"
                                   for="inlineRadio{!! $catItem->id !!}">{!! $catItem->names !!}</label>
                        </div>
                    @endforeach
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            {!! Form::label('names','ចំណងជើងអំ(៥០ពាក្យ)') !!}
                            {!! Form::text('names',null,['class'=>'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('detail','ពិពណ៌នាផលិតផល') !!}
                            {!! Form::textarea('detail',null,['class'=>'form-control','rows'=>2]) !!}
                        </div>

                        <div class="form-group">
                            {!! Form::label('day_warranty','រយៈពេលធានាក្រោយពេលទិញរួច(ថ្ងៃ)') !!}
                            {!! Form::text('day_warranty',null,['class'=>'form-control']) !!}
                        </div>

                        {{--<div class="form-group">
                            {!! Form::label('product_number','ចំនួនផលិតផល') !!}
                            <div class="input-group mb-3">
                                {!! Form::text('product_number',null,['class'=>'form-control']) !!}
                                <div class="input-group-append">
                                    <span class="input-group-text" id="add-key">Add Key</span>
                                </div>
                            </div>
                        </div>--}}
                        <div class="form-group">
                            {!! Form::label('product_key_list','Product Key') !!}
                            {!! Form::textarea('product_key_list',null,['class'=>'form-control','rows'=>2,'placeholder'=>'key 1
key2
key3']) !!}
                        </div>
                        <div class="form-group">
                            {{ Form::label('product_key_file','Product Key File') }}
                            <input accept=".txt" class="form-control" type='file' id="product_key_file" name="product_key_file"/>
                      <small style="color: red">Note: One line one product key</small>
                        </div>

                        <div class="form-group">
                            {!! Form::label('price','តម្លៃ($)') !!}
                            {!! Form::text('price',null,['class'=>'form-control']) !!}
                        </div>


                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('image','រូបភាពដាក់បង្ហាញ (ទំហំ 1080px X 1080px)') }}
                                    <input accept="image/*" type='file' id="photo" name="photo"/>
                                    @if($product)
                                        <div class="preview-image" id="preview-image"
                                             style="background: url({!! asset('uploads/'.$product->photo) !!})"></div>
                                    @else
                                        <div class="preview-image" id="preview-image"
                                             style="background: url({!! asset('photo/image-gallery.png') !!})"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('image','ប្រើរូបភាពគម្រូ') }}
                                    <input accept="image/*" type='file' id="photos" name="photos[]" multiple/>
                                </div>
                            </div>

                            @if($product && $product->productPhoto)
                                <div class="row">
                                    @foreach($product->productPhoto as $key=>$photo)
                                        <div class="col-md-3">
                                            <div class="preview-image-1" id="preview-image"
                                                 style="background: url({!! asset('uploads/'.$photo->photo) !!})"></div>
                                            {{--             <input class="form-check-input" type="radio" name="sample_photo"
                                                                id="photo{!! $photo->id !!}" value="{!! $photo->photo !!}">
                                                         <label class="form-check-label"
                                                                for="photo{!! $photo->id !!}">រូបភាពគម្រូ{!! $key+1 !!}</label>--}}
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>


                <table class="table table-bordered" id="table-key">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Key</th>
                        <th>
                            <button type="button" id="add-more-key" class="btn btn-outline-primary btn-sm">Add Key
                            </button>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($product && $product->productKey)
                        @php
                            $i=1
                        @endphp
                        @foreach($product->productKey as $key)
                            <tr>
                                <td width="3%">{!! $i !!}</td>
                                <td width="10%"> {!! $key->product_key !!}</td>
                                <td width="3%">
                                    @if($key->status)
                                        <span class="badge badge-primary bg-success">ទំនេរ</span>
                                    @endif
                                </td>
                            </tr>
                            @php( $i++)
                        @endforeach
                    @endif

                    </tbody>
                </table>


                <div class="row mt-5">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> ផុសលក់</button>
                        <button type="reset" class="btn btn-secondary"><i class="fas fa-save"></i> សម្អាត</button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <x-slot name="script">
        <script>
            // $('#detail').summernote({});


            $('#add-key').on('click', function () {
                var product_number = $('#product_number').val();
                var keyHtml = '';
                for (let i = 1; i <= product_number; i++) {
                    keyHtml += '<tr>' +
                        '<td>' + i + '</td>' +
                        '<td><input type="text" class="form-control" name="product_key[]"/> </td>' +
                        '<td><span class="badge badge-primary bg-success">ទំនេរ</span></td>' +
                        '</tr>';
                }

                $('#table-key tbody').html(keyHtml)

            });
            $('#add-more-key').on('click', function () {
                var keyHtml = '<tr>' +
                    '<td></td>' +
                    '<td><input type="text" class="form-control" name="product_key[]"/> </td>' +
                    '<td><span class="badge badge-primary bg-success">ទំនេរ</span></td>' +
                    '</tr>';

                $('#table-key tbody').append(keyHtml)

            })

            $("#photo").change(function () {
                readURL(this, '#preview-image');
            });


            $("#productForm").validate({
                rules: {
                    names: "required",
                    detail: "required",
                    category_id: "required",
                    day_warranty: {
                        required: true,
                        number: true
                    },
                    product_number: {
                        required: true,
                        number: true
                    },
                    price: {
                        required: true,
                        number: true
                    },
                    // photo: "required",
                },
                /*messages: {
                    names: "Please enter your name",
                    detail: "Please enter your content detail",
                    category_id: "Please select category",
                    product_number: "Please enter number of product",
                },*/
                errorElement: "em",
                errorPlacement: function (error, element) {
                    // Add the `invalid-feedback` class to the error element
                    error.addClass("invalid-feedback");

                    if (element.prop("type") === "checkbox") {
                        error.insertAfter(element.next("label"));
                    } else {
                        error.insertAfter(element);
                    }
                },
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-invalid").removeClass("is-valid");
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).addClass("is-valid").removeClass("is-invalid");
                }
            });


            function readURL(input, preiview) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(preiview).css('background-image', 'url("' + e.target.result + '")');
                    }
                    reader.readAsDataURL(input.files[0]);
                } else {
                    $(preiview).css('background-image', '');
                }
            }
        </script>
    </x-slot>
</x-app-layout>
