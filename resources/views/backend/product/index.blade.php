<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>

    @php
        $fields = [
            ['name' => 'id', 'label' => 'ID', 'width' => ''],
            ['name' => 'names', 'label' => 'Name', 'width' => ''],
            ['name' => 'status', 'label' => 'Status', 'width' => ''],
            ['name' => 'action', 'label' => 'Action', 'width' => ''],
        ];
    @endphp

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            {!! \App\Models\Helper::datatable($fields, 'product_list', 1, route('products.create')) !!}
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function () {
                let table = $('#product_list').dataTable({
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    colReorder: true,
                    dom: 'lifrtp',
                    searching: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route('products.index') !!}',
                        data: d => d.brand_id = $('#brand_id').val()
                    },
                    columns: [
                        @foreach($fields as $field)
                        { data: '{{ $field['name'] }}', width: '{{ $field['width'] }}' },
                        @endforeach
                    ],
                });

                // Form Submission with AJAX
                $('#category_form').ajaxForm(data => {
                    if (data.success) {
                        $('#createFormModal').modal('hide');
                        $('#product_form')[0].reset();
                        {!! \App\Models\Helper::alertSuccess() !!}
                        table.fnDraw();
                    }
                });

                // Search Button
                $('#searchButton').click(() => {
                    table.fnDraw();
                    return false;
                });

                // Delete Action
                $(document).on('click', '#delete', function (e) {
                    e.preventDefault();
                    let link = $(this).data("link");

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then(result => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: link,
                                type: 'DELETE',
                                data: { _token: '{!! csrf_token() !!}' },
                                success: result => {
                                    if (result.success) {
                                        table.fnDraw();
                                        Swal.fire('Deleted!', 'Your file has been deleted.', 'success');
                                    }
                                }
                            });
                        }
                    });
                });

                // Edit Action
                $(document).on('click', '#edit', function () {
                    let link = $(this).data("link");
                    let id = $(this).data("id");

                    $.get(link, function (data) {
                        if (data.success) {
                            let get_data = data.data;
                            $('#category_form').attr('action', '{!! route('categories.index') !!}/' + id)
                                               .append('<input name="_method" type="hidden" value="PUT">');
                            $('.modal-title').text('Category Account');
                            $('#names').val(get_data.names);
                            $('#status').val(get_data.status);
                            $('#createFormModal').modal('show');
                        }
                    });
                });

                // Reset Form on Modal Close
                $('#createFormModal').on('hidden.bs.modal', function () {
                    $('#category_form')[0].reset();
                });
            });
        </script>
    </x-slot>
</x-admin-layout>
