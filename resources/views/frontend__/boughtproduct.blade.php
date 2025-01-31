<x-app-layout>
    <?php

    $id = Auth::guard('seller')->user()->id;
    $seller = App\Models\Seller::find($id);

    ?>
    <div style="padding-top:50px;">
        <div class="container">
            <div class="product-wrap">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Date</th>
                        <th>Seller</th>
                        <th>Product Name</th>
                        <th>Total</th>
                        <th>Promo Code</th>
                        <th>Discount</th>
                        <th>Grand Total</th>
                        <th>Product Key</th>
                        <th>Chat</th>
                        <th>Status</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($sell as $key=>$s)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$s->dates}}</td>

                            <td>
                                <?php
                                $buyer = App\Models\Seller::find($s->seller_id);
                                ?>
                                <a href="{!! route('sellerProfile',str_replace(' ','_',optional($buyer)->full_name)) !!}">{{$buyer->full_name}}</a>
                            </td>
                            <td><a href="{!! route('productDetail',$s->sku) !!}">{{$s->names}}</a></td>
                            <td>{{$s->total}}</td>

                            <td>{{$s->promo_code}}</td>
                            <td>{{$s->discount}}</td>
                            <td>{{$s->grand_total}}</td>
                            <td>
                                @if($s->product_key)
                                    @foreach(json_decode($s->product_key) as $item)
                                        {!! $item  !!} <br>
                                    @endforeach
                                @endif
                            </td>
                            <td><a href="{{route('frontend__.chatseller',['seller'=>$s->seller_id])}}"
                                   class="btn btn-chat"><i class="fab fa-rocketchat"></i> Chat</a></td>

                            <td>
                                @if($s->status)
                                    <span class="badge bg-success">Paid</span>
                                @else
                                    <span class="badge bg-danger">Unpaid</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
