<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coupon Code') }}
        </h2>
    </x-slot>


    @php
        $fields=[
               [ 'name'=>'id', 'label'=>'ID','width'=>'', ],
               [ 'name'=>'coupon_name', 'label'=>'Coupon Name','width'=>'' ],
               [ 'name'=>'coupon_code', 'label'=>'Coupon Code','width'=>'' ],
               [ 'name'=>'percentage', 'label'=>'Percentage','width'=>'' ],
               [ 'name'=>'expired_date', 'label'=>'Expired Date','width'=>'' ],
               [ 'name'=>'status', 'label'=>'Status','width'=>'' ],
               [ 'name'=>'action', 'label'=>'Action','width'=>'' ],

        ]

    @endphp
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">

            {!! \App\Models\Helper::datatable($fields,'coupon_list') !!}

            {!! \App\Models\Helper::ModelForm($fields,'modal-lg','Create Coupon',
'
<div class="row">
    <div class="col">
        <div class="form-group"> '.Form::label('coupon_name').  Form::text('coupon_name',null,['class'=>'form-control','required']) .'</div>
    </div>
    <div class="col">
        <div class="form-group"> '.Form::label('coupon_code').  Form::text('coupon_code',null,['class'=>'form-control','required']) .'</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group"> '.Form::label('flat').  Form::text('flat',null,['class'=>'form-control','required']) .'</div>
    </div>
    <div class="col">
        <div class="form-group"> '.Form::label('percentage').  Form::text('percentage',null,['class'=>'form-control','required']) .'</div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="form-group"> '.Form::label('expired_date').  Form::date('expired_date',null,['class'=>'form-control','required']) .'</div>
    </div>
    <div class="col">
        <div class="form-group"> '.Form::label('status').  Form::text('status',null,['class'=>'form-control','required']) .'</div>
    </div>
</div>
','coupon-code.store','coupon_form') !!}
        </div>
    </div>




    <x-slot name="script">
        <script>
            $(document).ready(function () {
                var table = $('#coupon_list').dataTable({
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    colReorder: true,
                    dom: 'lifrtp',
                    searching: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route('coupon-code.index') !!}',
                        data: function (d) {
                            d.brand_id = $('#brand_id').val();
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
                $('#coupon_form').ajaxForm(function (data) {
                    if (data.success == true) {
                        $('#createFormModal').modal('hide');
                        $('#coupon_form').resetForm();
                        {!! \App\Models\Helper::alertSuccess() !!}
                        table.fnDraw();
                    }
                });

                $('#searchButton').click(function () {
                    table.fnDraw();
                    return false;
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

                                        table.fnDraw();
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
                        if(data.success==true){
                            var get_data = data.data;
                            $('#coupon_form').attr('action','{!! route('coupon-code.index') !!}/'+id)
                            $('#coupon_form').append('<input name="_method" type="hidden" value="PUT">')
                            $('.modal-title').text('Coupon Code');
                            $('#coupon_name').val(get_data.coupon_name);
                            $('#coupon_code').val(get_data.coupon_code);
                            $('#flat').val(get_data.flat);
                            $('#percentage').val(get_data.percentage);
                            $('#expired_date').val(get_data.expired_date);
                            $('#status').val(get_data.status);
                            /*$('.id_card').attr(get_data.id_card);
                            $('.id_card_face').val(get_data.id_card_face);*/

                            $('#createFormModal').modal('show');
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
