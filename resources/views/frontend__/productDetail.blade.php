<x-app-layout>

    <div class="container">
        <div class="product-wrap">

            <div class="product-detail">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="image-box">
                        <img style="width:100%" src="{{url('uploads/'.$product->photo)}}"
                             alt="">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="trending-title">
                            <h1><i class="fas fa-fire"></i> {!! $product->names !!}</h1>
                            Seller: <a style="text-decoration:none"
                                       href="{!! route('sellerProfile',str_replace(' ','_',optional($product->seller)->full_name)) !!}">
                                <i class="far fa-user"></i><span> {!! optional($product->seller)->full_name !!}</span>
                            </a>
                            <a href="{{route('frontend__.chatseller',['seller'=>optional($product->seller)->id])}}"
                               class="btn btn-chat"><i class="fab fa-rocketchat"></i> Chat Now</a>
                        </div>
                        <p class="price">ប្រភេទ៖ <span>{!! $product->category->names !!}</span></p>
                        <h5 class="price">តម្លៃ៖ <span>{!! $product->price !!}</span></h5>

                        <div class="desc">

                            {!! $product->detail !!}
                        </div>


                        <div class="row">
                            <div class="col-md-2">
                                <select class="form-control text-center mb-2" name="qty" id="qty" placeholder="រើសចំនួន" >
                                    @for($i=1;$i<10;$i++)
                                        <option value="{!! $i !!}">{!! $i !!}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-4">
                                <a href="{!! route('addCart',['id'=>$product->id,'buy_now'=>1]) !!}" data-link="{!! route('addCart',['id'=>$product->id,'buy_now'=>1]) !!}" id="add-cart"
                                   type="button"
                                   class="btn add-cart"><i
                                        class="fas fa-cart-plus"></i>
                                    Buy Now
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>
    </div>

    <x-slot name="script">
        <script>
            $(document).ready(function () {
                $('#qty').on('change', function () {
                    var qty = $(this).val();
                    var link = $('#add-cart').data('link');
                    $('#add-cart').attr('href', link + '&qty=' + qty);
                });
            });
        </script>
    </x-slot>
</x-app-layout>
