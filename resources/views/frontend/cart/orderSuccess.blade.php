<x-app-layout>
    <div class="container">
        <div class="product-wrap">
            <div class="row">
                <div class="col-md-12">
                    <div class="trending-title">
                        <h1><i class="fas fa-cart-plus"></i> Order Detail</h1>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                        <tr class="text-center">
                            <th align="center">No</th>
                            <th align="center">Product Name</th>
                            <th align="center">Qty</th>
                            <th align="center">Price</th>
                            <th align="center">Total</th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php $total = 0; ?>
                        @if($sell)
                            <?php

                            $i = 1;

                            ?>
                            @foreach($sell->sellDetail as  $id => $details)
                                <tr data-id="{{ $id }}">
                                    <td align="center">{!! $i !!}</td>
                                    <td data-th="Product" align="center">
                                        <div class="row product-cart">
                                            <div class="col-sm-4 hidden-xs">
                                                <div class="cart-thumb"
                                                     style="background: url({!! asset('uploads/'.$details->product->photo) !!})"></div>
                                            </div>
                                            <div class="col-sm-8 text-start">
                                                <p class="nomargin">{{ $details->product->names }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price" align="center">${{ $details->price }}</td>
                                    <td data-th="Quantity" align="center" width="10%">{{ $details['qty'] }}</td>
                                    <td data-th="Subtotal" class="text-center" align="center">
                                        ${{ $details->amount }}</td>
                                </tr>


                            @endforeach
                        @endif


                        </tbody>
                    </table>


                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-4">

                    <table class="table table-responsive table-bordered">
                        <tr>
                            <td>Total:</td>
                            <td>${!! number_format($sell->total,2) !!}</td>
                        </tr>
                        <tr>
                            <td>Discount:</td>
                            <td>${!! number_format($sell->discount,2) !!}</td>
                        </tr>
                        <tr>
                            <td>Grand Total:</td>
                            <td>${!! number_format($sell->grand_total,2) !!}</td>
                        </tr>
                    </table>

                </div>
            </div>

            <div class="row">
                <div class="col text-center">
                    <a href="{!! route('homePage') !!}" class="btn btn-primary"><i class="fas fa-arrow-left"></i> Back to Home</a>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
