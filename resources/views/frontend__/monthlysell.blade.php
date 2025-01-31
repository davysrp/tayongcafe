<x-app-layout>

    <div style="padding-top:50px;">
        <div class="container">
            <div class="product-wrap">
                <h1 style="text-align:center; font-size: 32px;">រាបាយការណ៍លក់ប្រចាំខែ</h1>
                {!! Form::open(['route'=>['frontend__.monthlysell',$seller],'method'=>'get']) !!}
                <div class="row">
                    <div class="col-md-4">
                        {!! Form::text('order_date',null,['class'=>'form-control','id'=>'order_date']) !!}
                    </div>
                    <div class="col-md-3">
                        {!! Form::select('status',[null=>'All',1=>'Paid','0'=>'Unpaid'],null,['class'=>'form-control','id'=>'order_date']) !!}
                    </div>
                    <div class="col-md-4">
                        {!! Form::submit('Search',['class'=>'btn btn-primary']) !!}
                    </div>
                </div>
                {!! Form::close() !!}

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Date</th>
                        <th>Buyer</th>
                        <th>Total</th>
                        <th>Promo Code</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php

                        $total=0;

                    @endphp
                    @foreach($sell as $key=>$s)

                        @php
                            $sllTotal=$s->sellDetail->sum('amount');
                            $total=$total+$sllTotal;

                        @endphp

                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{ \Illuminate\Support\Carbon::parse($s->dates)->format('d/m/y') }}</td>
                            <td>
                                {!! optional($s->buyer)->full_name !!}
                            </td>
                            <td>{{ number_format($s->sellDetail->sum('amount'),2) }}</td>
                            <td>{{$s->promo_code}}</td>
                            <td>{{ number_format($s->discount,2) }}</td>
                            <td>{{ number_format($s->grand_total,2) }}</td>
                            <td>{{ optional($s->patymentMethod)->names}}</td>
                            <td>@if($s->status)
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-warning">Unpaid</span>
                                @endif</td>
                        </tr>
                    </tbody>
                    @endforeach
                    <tfoot>
                    <tr style="background:#babba4">
                        <td colspan=7 style="text-align:right">
                            <?php
                            $sum_grand_total = DB::table('products')->select('grand_total')
                                ->join('sell_details', 'products.id', '=', 'sell_details.product_id')
                                ->join('sells', 'sells.id', '=', 'sell_details.sell_id')
                                ->where('seller_id', $seller)->sum('grand_total');
                            ?>
                            <b>Total : {!! number_format($sum_grand_total,2) !!}</b>
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>


    <x-slot name="css">
        <link href="{!! asset('assets/vendor/daterangepicker/daterangepicker.css') !!}" rel="stylesheet">
    </x-slot>
    <x-slot name="script">
        <script src="{!! asset('assets/vendor/moment/moment.min.js') !!}"></script>
        <script src="{!! asset('assets/vendor/daterangepicker/daterangepicker.js') !!}"></script>
        <script>
            $('#order_date').daterangepicker({
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });
        </script>
    </x-slot>
</x-app-layout>
