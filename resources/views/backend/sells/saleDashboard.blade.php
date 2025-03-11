<x-admin-layout>
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

            {{-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                    class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
        </div>
        <!-- Content Row -->
        <div class="row">


        <?php
        $tables = \App\Models\Table::all();

        ?>

        <!-- Earnings (Monthly) Card Example -->
            @foreach($tables as $item)
                <div class="col-xl-3 col-md-6 mb-4">
                    <a href="{!! route('saleForm',$item->id) !!}">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        {{-- <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            {!! $item->names !!}
                                         </div>--}}
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"> {!! $item->names !!}</div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-utensils fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
</x-admin-layout>
