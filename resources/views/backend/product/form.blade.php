{{-- <div class="row">
    <div class="col">
        <div
            class="form-group"> {!! Form::label('names').  Form::text('names',null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div
            class="form-group"> {!! Form::label('price').  Form::text('price',null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div
            class="form-group"> {!! Form::label('photo').  Form::file('photo',null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div
            class="form-group"> {!! Form::label('status').  Form::select('status',[1=>'Active',0=>'Inactive'],null,['class'=>'form-control','required']) !!}</div>
    </div>
    <div class="col">
        <div
            class="form-group"> {!! Form::label('category_id').  Form::select('category_id',$category,null,['class'=>'form-control','required']) !!}</div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped" id="product-variant-table">
            <thead>
            <tr>
                <th width="10%">Code</th>
                <th width="10%">Name</th>
                <th width="10%">Price</th>
                <th width="10%">Size</th>
                <th width="10%">Status</th>
                <th width="10%">
                    <button type="button" class="btn btn-primary" id="add-variant"><i class="fas fa-plus"></i> Add
                        Product Variant
                    </button>
                </th>
            </tr>
            </thead>
            <tbody>
            @if(isset($model))

                @foreach($model->productVariant as $item)
                    <tr id="row-{!! $item->id !!} ">
                        <td>
                            <input type="hidden" class="form-control" value="{!! $item->id !!}" name="variant_id[]">
                            <input type="text" class="form-control" value="{!! $item->variant_code !!}"
                                   name="variant_code[]">
                        </td>
                        <td><input type="text" class="form-control" value="{!! $item->variant_name !!}"
                                   name="variant_name[]"></td>
                        <td><input type="text" class="form-control" value="{!! $item->variant_price !!}"
                                   name="variant_price[]"></td>
                        <td><input type="text" class="form-control" value="{!! $item->variant_size !!}"
                                   name="variant_size[]"></td>
                        <td>
                            {!! Form::select('variant_status[]',[1=>'Active',0=>'Inactive'],$item->status,['class'=>'form-control','required']) !!}
                        </td>
                        <td>
                            <button type="button" id="remove-item" data-id="{!! $item->id !!}" class="btn btn-danger"><i
                                    class="fas fa-minus"></i> Remove
                            </button>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
</div>
<x-slot name="script">
    <script>
        


        $(document).ready(function () {
            
            // Add Variant Row
            $('#add-variant').click(function () {
                var html = '';
                var id = makeid(12); // Generate a unique ID
            
                html += '<tr id="row-' + id + '">';
                html += '<td><input type="text" class="form-control" name="variant_code[]"> </td>';
                html += '<td><input type="text" class="form-control" name="variant_name[]"> </td>';
                html += '<td><input type="text" class="form-control" name="variant_price[]"> </td>';
                html += '<td><input type="text" class="form-control" name="variant_size[]"> </td>';
                html += '<td>{!! Form::select('variant_status[]',[1=>'Active',0=>'Inactive'],null,['class'=>'form-control','required'])         !!}</td>';
                html += '<td><button type="button" id="remove-item" data-id="' + id + '" class="btn btn-danger"><i class="fas fa-minus"></      i> Remove</button> </td>';
                html += '</tr>';
                
                $('#product-variant-table tbody').append(html); // Append the new row to the table
            });
        
            // Remove Variant Row
            $('body').delegate('#remove-item', 'click', function () {
                var id = $(this).data('id'); // Get the data-id of the clicked button
                $('#row-' + id).remove(); // Remove the row with the matching ID
            });
        
            // Function to generate a unique ID
            function makeid(length) {
                let result = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const charactersLength = characters.length;
                let counter = 0;
                while (counter < length) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    counter += 1;
                }
                return result;
            }
        });

    </script>

</x-slot> --}}


<div class="row">
    <div class="col">
        <div class="form-group">
            {!! Form::label('names') !!}
            {!! Form::text('names', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('price') !!}
            {!! Form::number('price', null, ['class' => 'form-control', 'required', 'step' => '0.01']) !!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('photo') !!}
            {!! Form::file('photo', null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('status') !!}
            {!! Form::select('status', [1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
    <div class="col">
        <div class="form-group">
            {!! Form::label('category_id') !!}
            {!! Form::select('category_id', $category, null, ['class' => 'form-control', 'required']) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped" id="product-variant-table">
            <thead>
                <tr>
                    <th width="10%">Code</th>
                    <th width="10%">Name</th>
                    <th width="10%">Price</th>
                    <th width="10%">Size</th>
                    <th width="10%">Status</th>
                    <th width="10%">
                        <button type="button" class="btn btn-primary" id="add-variant">
                            <i class="fas fa-plus"></i> Add Product Variant
                        </button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @if(isset($model))
                    @foreach($model->productVariant as $item)
                        <tr id="row-{!! $item->id !!}">
                            <td>
                                <input type="hidden" class="form-control" value="{!! $item->id !!}" name="variant_id[]">
                                <input type="text" class="form-control" value="{!! $item->variant_code !!}" name="variant_code[]">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{!! $item->variant_name !!}" name="variant_name[]">
                            </td>
                            <td>
                                <input type="number" class="form-control variant-price" value="{!! $item->variant_price !!}" name="variant_price[]" step="0.01">
                            </td>
                            <td>
                                <input type="text" class="form-control" value="{!! $item->variant_size !!}" name="variant_size[]">
                            </td>
                            <td>
                                {!! Form::select('variant_status[]', [1 => 'Active', 0 => 'Inactive'], $item->status, ['class' => 'form-control', 'required']) !!}
                            </td>
                            <td>
                                <button type="button" class="btn btn-danger remove-item" data-id="{!! $item->id !!}">
                                    <i class="fas fa-minus"></i> Remove
                                </button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<x-slot name="script">
    <script>
        $(document).ready(function () {
            // Add Variant Row
            $('#add-variant').click(function () {
                var id = makeid(12); // Generate a unique ID
                var html = `
                    <tr id="row-${id}">
                        <td><input type="text" class="form-control" name="variant_code[]"></td>
                        <td><input type="text" class="form-control" name="variant_name[]"></td>
                        <td><input type="number" class="form-control variant-price" name="variant_price[]" step="0.01"></td>
                        <td><input type="text" class="form-control" name="variant_size[]"></td>
                        <td>
                            {!! Form::select('variant_status[]', [1 => 'Active', 0 => 'Inactive'], null, ['class' => 'form-control', 'required']) !!}
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger remove-item" data-id="${id}">
                                <i class="fas fa-minus"></i> Remove
                            </button>
                        </td>
                    </tr>`;

                $('#product-variant-table tbody').append(html); // Append the new row to the table
            });

            // Remove Variant Row
            $(document).on('click', '.remove-item', function () {
                var id = $(this).data('id');
                $('#row-' + id).remove(); // Remove the row with the matching ID
            });

            // Enforce numeric input for price fields
            $(document).on('input', '.variant-price, input[name="price"]', function () {
                this.value = this.value.replace(/[^0-9.]/g, ''); // Allow only numbers and decimal points
            });

            // Function to generate a unique ID
            function makeid(length) {
                let result = '';
                const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
                const charactersLength = characters.length;
                let counter = 0;
                while (counter < length) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                    counter += 1;
                }
                return result;
            }
        });
    </script>
</x-slot>
