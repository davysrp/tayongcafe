<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Customer') }}
        </h2>
    </x-slot>

    @php
        $fields = [
            [ 'name' => 'id', 'label' => 'ID', 'width' => '' ],
            [ 'name' => 'first_name', 'label' => 'First Name', 'width' => '' ],
            [ 'name' => 'last_name', 'label' => 'Last Name', 'width' => '' ],
            [ 'name' => 'email', 'label' => 'Email', 'width' => '' ],
            [ 'name' => 'phone_number', 'label' => 'Phone Number', 'width' => '' ],
            [ 'name' => 'action', 'label' => 'Action', 'width' => '' ],
        ];
    @endphp
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div> --}}
        <div class="card-body">
            {!! \App\Models\Helper::datatable($fields, 'customer_list', 1, route('customers.create')) !!}
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function () {
                var table = $('#customer_list').dataTable({
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    colReorder: true,
                    dom: 'lifrtp',
                    searching: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route('customers.index') !!}',
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

                $('#customer_form').ajaxForm(function (data) {
                    if (data.success == true) {
                        $('#createFormModal').modal('hide');
                        $('#customer_form').resetForm();
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
                            $('#customer_form').attr('action','{!! route('customers.index') !!}/'+id)
                            $('#customer_form').append('<input name="_method" type="hidden" value="PUT">')
                            $('.modal-title').text('Update Customer');
                            $('#first_name').val(get_data.first_name);
                            $('#last_name').val(get_data.last_name);
                            $('#email').val(get_data.email);
                            $('#phone_number').val(get_data.phone_number);

                            $('#createFormModal').modal('show');
                        }
                    });
                });

                $('#createFormModal').on('hidden.bs.modal', function () {
                    $('#createFormModal').resetForm();
                });
            });
        </script>
    </x-slot>
</x-admin-layout>