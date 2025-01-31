<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Coupon Codes') }}
        </h2>
    </x-slot>

    @php
        $fields = [
            [ 'name' => 'id', 'label' => 'ID', 'width' => '' ],
            [ 'name' => 'coupon_name', 'label' => 'Coupon Name', 'width' => '' ],
            [ 'name' => 'coupon_code', 'label' => 'Coupon Code', 'width' => '' ],
            [ 'name' => 'percentage', 'label' => 'Percentage', 'width' => '' ],
            [ 'name' => 'expired_date', 'label' => 'Expired Date', 'width' => '' ],
            [ 'name' => 'status', 'label' => 'Status', 'width' => '' ],
            [ 'name' => 'action', 'label' => 'Action', 'width' => '' ],
        ];
    @endphp
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Coupon Codes</h6>
            <a href="{{ route('coupon-code.create') }}" class="btn btn-primary btn-sm float-right">Add Coupon</a>
        </div>
        <div class="card-body">
            {!! \App\Models\Helper::datatable($fields, 'coupon_list', 1, route('coupon-code.create')) !!}
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
                    },
                    columns: [
                        @foreach($fields as $field)
                        {
                            data: '{!! $field['name'] !!}', width: '{!! $field['width'] !!}'
                        },
                        @endforeach
                    ],
                });

                $(document).on('click', '.delete-btn', function (e) {
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
                                    _token: $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (result) {
                                    if (result.success == true) {
                                        table.fnDraw();
                                        Swal.fire(
                                            'Deleted!',
                                            'Your coupon has been deleted.',
                                            'success'
                                        )
                                    }
                                }
                            });
                        }
                    })
                });
            });
        </script>
    </x-slot>
</x-admin-layout>
