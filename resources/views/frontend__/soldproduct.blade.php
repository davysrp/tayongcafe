<x-app-layout>
    <?php

    $id = Auth::guard('seller')->user()->id;
    $seller = App\Models\Seller::find($id);

    ?>
    <div>
        <div class="container">
            <div class="post-product-container">

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
                    @foreach($sell as $key=>$s)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$s->dates}}</td>

                            <td>
                                <?php
                                $buyer = App\Models\Seller::find($s->seller_id_buyer);

                                ?>
                                <a href="{!! route('sellerProfile',str_replace(' ','_',optional($buyer)->full_name)) !!}">{{$buyer->full_name}}</a>
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

</x-app-layout>
