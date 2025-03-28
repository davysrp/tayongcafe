<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User Admin') }}
        </h2>
    </x-slot>


    @php
        $fields=[
               [ 'name'=>'id', 'label'=>'ID','width'=>'', ],
               [ 'name'=>'name', 'label'=>'Name','width'=>'' ],
               [ 'name'=>'email', 'label'=>'Email','width'=>'' ],
            //    [ 'name'=>'status', 'label'=>'Status','width'=>'' ],
               [ 'name'=>'created_at', 'label'=>'Created_at','width'=>'' ],
               [ 'name'=>'updated_at', 'label'=>'Updated_at','width'=>'' ],
               [ 'name'=>'action', 'label'=>'Action','width'=>'' ],
        ]

    @endphp
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div> --}}
        <div class="card-body">
            {!! \App\Models\Helper::datatable($fields,'seller_list',1,route('users.create')) !!}
        </div>
    </div>


    <x-slot name="script">
        <script>
            $(document).ready(function () {
                var table = $('#seller_list').dataTable({
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    colReorder: true,
                    dom: 'lifrtp',
                    searching: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route('users.index') !!}',
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
                $('#seller_form').ajaxForm({
                    success:function (data) {
                        if (data.success == true) {
                            $('#createFormModal').modal('hide');
                            $('#seller_form').resetForm();
                            {!! \App\Models\Helper::alertSuccess() !!}
                            table.fnDraw();
                            return false;
                        }
                    },
                    error:function (data) {
                        var message ='';
                        $.each(data.responseJSON.errors,function (key,value) {
                            message += value +  '</br>';
                        })
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            html: message,
                        });
                    }
                })

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
                                        {!! \App\Models\Helper::alertDeleteSuccess() !!}
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
                            $('#seller_form').attr('action', '{!! route('users.index') !!}/' + id)
                            $('#seller_form').append('<input name="_method" type="hidden" value="PUT">')
                            $('.modal-title').text('Update User Account');
                            $('#name').val(get_data.name);
                            $('#email').val(get_data.email);
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
