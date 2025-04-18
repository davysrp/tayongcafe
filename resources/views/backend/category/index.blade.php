<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Category') }}
        </h2>
    </x-slot>


    @php
        $fields=[
               [ 'name'=>'id', 'label'=>'ID','width'=>'', ],
               [ 'name'=>'names', 'label'=>'Name','width'=>'' ],
               [ 'name'=>'status', 'label'=>'Status','width'=>'' ],
               [ 'name'=>'action', 'label'=>'Action','width'=>'' ],

        ]

    @endphp
    <div class="card shadow mb-4">
        {{-- <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div> --}}
        <div class="card-body">

            {!! \App\Models\Helper::datatable($fields,'category_list',1,route('categories.create')) !!}

        </div>
    </div>


    <x-slot name="script">
        <script>
            $(document).ready(function () {
                var table = $('#category_list').dataTable({
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    colReorder: true,
                    dom: 'lifrtp',
                    searching: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route('categories.index') !!}',
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
                $('#category_form').ajaxForm(function (data) {
                    if (data.success == true) {
                        $('#createFormModal').modal('hide');
                        $('#category_form').resetForm();
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
                        if (data.success == true) {
                            var get_data = data.data;
                            $('#category_form').attr('action', '{!! route('categories.index') !!}/' + id)
                            $('#category_form').append('<input name="_method" type="hidden" value="PUT">')
                            $('.modal-title').text('Category Account');
                            $('#names').val(get_data.names);
                            $('#icon').val(get_data.icon);
                            if (get_data.status === 1) $('#status').prop('checked', 'checked');
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
