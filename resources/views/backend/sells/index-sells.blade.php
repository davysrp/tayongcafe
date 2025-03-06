<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Sells') }}
        </h2>
    </x-slot>


    @php
        $fields = [
            [ 'name'=>'id', 'label'=>'ID', 'width'=>'' ],
            [ 'name'=>'invoice_no', 'label'=>'Invoice', 'width'=>'' ],
            [ 'name'=>'dates', 'label'=>'Date', 'width'=>'' ],
            [ 'name'=>'times', 'label'=>'Time', 'width'=>'' ],
            [ 'name'=>'customer', 'label'=>'Customer', 'width'=>'' ],
            [ 'name'=>'total', 'label'=>'Total', 'width'=>'' ],
            [ 'name'=>'coupon_name', 'label'=>'Coupon Code', 'width'=>'' ],
            [ 'name'=>'discount', 'label'=>'Discount', 'width'=>'' ],
            [ 'name'=>'grand_total', 'label'=>'Grand Total', 'width'=>'' ],
            [ 'name'=>'payment_method', 'label'=>'Payment Method', 'width'=>'' ],
            [ 'name'=>'status', 'label'=>'Status', 'width'=>'' ],
            [ 'name'=>'action', 'label'=>'Action', 'width'=>'' ],
        ];
    @endphp


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            {!!  Form::text('order_date',null,['class'=>'form-control','id'=>'order_date','placeholder'=>'Order Date']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            {!!  Form::text('customer',null,['class'=>'form-control','id'=>'customer','placeholder'=>'Customer']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <div class="form-group">
                            {!!  Form::select('status',[0=>'Unpaid',1=>'Paid'],null,['class'=>'form-control','id'=>'status','placeholder'=>'Status']) !!}
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                    <div class="form-group">
                        <div class="form-group">
                            <button type="button" class="btn btn-outline-primary" id="Search">Search</button>
                        </div>
                    </div>
                </div>
            </div>


            {!! \App\Models\Helper::datatable($fields,'sells_list',0) !!}
            {!! \App\Models\Helper::ModelForm($fields,'modal-lg','Create Sells ',
                '
                <div class="row">
                    <div class="col">
                        <div class="form-group"> '.Form::label('dates') .  Form::date('dates',null,['class'=>'form-control','required']) .'</div>
                    </div>
                    <div class="col">
                        <div class="form-group"> '.Form::label('times').  Form::time('times',null,['class'=>'form-control','required']) .'</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group"> '.Form::label('seller_id_buyer').  Form::text('seller_id_buyer',null,['class'=>'form-control','required']) .'</div>
                    </div>
                    <div class="col">
                        <div class="form-group"> '.Form::label('seller_id_seller').  Form::text('seller_id_seller',null,['class'=>'form-control','required']) .'</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group"> '.Form::label('total').  Form::number('total',null,['class'=>'form-control','required']) .'</div>
                    </div>
                    <div class="col">
                        <div class="form-group"> '.Form::label('promo_code').  Form::text('promo_code',null,['class'=>'form-control','required']) .'</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group"> '.Form::label('discount').  Form::number('discount',null,['class'=>'form-control','required']) .'</div>
                    </div>
                    <div class="col">
                        <div class="form-group"> '.Form::label('grand_total').  Form::number('grand_total',null,['class'=>'form-control','required']) .'</div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group"> '.Form::label('pay_method')  . Form::text('pay_method',null,['class'=>'form-control','required']) .'</div>
                    </div>
                    <div class="col">
                        <div class="form-group"> '.Form::label('status')  . Form::text('status',null,['class'=>'form-control','required']) .'</div>
                    </div>
                </div>
                ','sells.store','sell_form') !!}
        </div>
    </div>
    <table>
        <x-slot name="script">
            <script>
                $(document).ready(function () {
                    var table = $('#sells_list').dataTable({
                        stateSave: true,
                        processing: true,
                        serverSide: true,
                        colReorder: true,
                        dom: 'lifrtp',
                        searching: false,
                        responsive: true,
                        ajax: {
                            url: '{!! route('sells.index') !!}',
                            data: function (d) {
                                d.order_date = $('#order_date').val();
                                d.customer = $('#customer').val();
                                d.status = $('#status').val();
                            }
                        },
                        columns: [
                                @foreach($fields as $field)
                            {
                                data: '{!! $field['name'] !!}', width: '{!! $field['width'] !!}'
                            },
                            @endforeach
                        ],
                    });
                    $('#Search').click(function () {
                        table.fnDraw();
                    })

                    $('#sell_form').ajaxForm(function (data) {
                        if (data.success == true) {
                            $('#createFormModal').modal('hide');
                            $('#sell_form').resetForm();

                            table.draw();
                        }
                    });
                    $('#order_date').daterangepicker({
                        locale: {
                            format: 'DD/MM/YYYY'
                        }
                    });

                    $(document).on('click', '#delete', function (e) {
                        e.preventDefault();
                        var link = $(this).data("link");
                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: link,
                                    type: 'DELETE',
                                    data: {
                                        _token: '{!! @csrf_token() !!}'
                                    },
                                    success: function (result) {
                                        if (result.success == true) {

                                            table.draw();
                                            Swal.fire(
                                                'Deleted!',
                                                'Your file has been deleted.',
                                                'success'
                                            )
                                        }

                                    }
                                });

                            }
                        })
                    });

                    $(document).on('click', '#edit', function (e) {
                        var link = $(this).data("link");
                        var id = $(this).data("id");
                        $.get(link, function (data) {
                            if (data.success == true) {
                                var get_data = data.data;
                                $('#sells_form').attr('action', '{!! route('sells.index') !!}/' + id)
                                $('.modal-title').text('Update Sell');
                                $('#dates').val(get_data.dates);
                                $('#times').val(get_data.times);
                                $('#seller_id_buyer').val(get_data.seller_id_buyer);

                                $('#total').val(get_data.total);
                                $('#promo_code').val(get_data.promo_code);
                                $('#discount').val(get_data.discount);
                                $('#grand_total').val(get_data.grand_total);
                                $('#pay_method').val(get_data.pay_method);
                                $('#status').val(get_data.status);

                                $('#createFormModal').modal('show');
                            }

                        });
                        $.ajax({
                            url: link,
                            type: 'DELETE',
                            data: {
                                _token: '{!! @csrf_token() !!}'
                            },
                            success: function (result) {
                                if (result.success == true) {

                                    table.draw();
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    )
                                }

                            }
                        });
                    });


                    $('#createFormModal').on('hidden.bs.modal', function () {
                        $('#createFormModal').resetForm();
                    });
                })
            </script>
        </x-slot>

</x-admin-layout>
