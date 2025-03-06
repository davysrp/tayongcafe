<x-admin-layout>
    <?php

//    $id = Auth::guard('seller')->user()->id;
//    $seller = App\Models\Seller::find($id);

    ?>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">List</h6>
        </div>
        <div class="card-body">
            <div style="padding-top:50px;">
                    <table class="table table-hover">
                        <tr>
                            <td></td>
                            <td>Date</td>
                            <td>Buyer</td>
                            <td>Product Name</td>
                            <td>Total</td>
                            <td>Promo Code</td>
                            <td>Discount</td>
                            <td>Grand Total</td>
                            <td>Payment Method</td>
                            <td>Status</td>
                        </tr>
                        @foreach($sell as $s)
                            <tr>
                                <td></td>
                                <td>{{$s->dates}}</td>

                                <td>
                                    <?php
                                    $buyer = App\Models\Seller::find($s->seller_id_buyer);

                                    ?>
                                    <a href="{!! route('sellerProfile',optional($buyer)->username) !!}">{{$buyer->full_name}}</a>
                                </td>
                                <td><a href="{!! route('productDetail',$s->sku) !!}">{{$s->names}}</a></td>
                                <td>{{$s->total}}</td>
                                <td>{{$s->promo_code}}</td>
                                <td>{{$s->discount}}</td>
                                <td>{{$s->grand_total}}</td>
                                <td><a href="{{route('frontend__.chatseller',['seller'=>$s->seller_id_buyer])}}"
                                       class="btn btn-chat"><i class="fab fa-rocketchat"></i> Chat</a></td>

                                <td>{{$s->status}}</td>
                            </tr>

                        @endforeach
                    </table>

            </div>
        </div>
    </div>


</x-admin-layout>
