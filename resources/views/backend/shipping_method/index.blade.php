<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Shipping Methods') }}
        </h2>
    </x-slot>

    @php
        $fields = [
            [ 'name' => 'id', 'label' => 'ID', 'width' => '' ],
            [ 'name' => 'name', 'label' => 'Name', 'width' => '' ],
            [ 'name' => 'status', 'label' => 'Status', 'width' => '' ],
            [ 'name' => 'action', 'label' => 'Action', 'width' => '' ],
        ];
    @endphp

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            {!! \App\Models\Helper::datatable($fields, 'shipping_method_list', 1, route('shipping-methods.create')) !!}
        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function () {
                var table = $('#shipping_method_list').dataTable({
                    stateSave: true,
                    processing: true,
                    serverSide: true,
                    colReorder: true,
                    dom: 'lifrtp',
                    searching: false,
                    responsive: true,
                    ajax: {
                        url: '{!! route('shipping-methods.index') !!}',
                    },
                    columns: [
                        @foreach($fields as $field)
                        { data: '{!! $field['name'] !!}', width: '{!! $field['width'] !!}' },
                        @endforeach
                    ],
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
                                data: { _token: '{!! csrf_token() !!}' },
                                success: function (result) {
                                    if (result.success == true) {
                                        table.fnDraw();
                                        Swal.fire('Deleted!', 'Shipping method has been deleted.', 'success');
                                    }
                                }
                            });
                        }
                    });
                });
            });
        </script>
    </x-slot>
</x-admin-layout>
