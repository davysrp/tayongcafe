<div class="container">
    <div class="product-wrap">
        <div class="row">
            <div class="col-md-12">
                <div class="trending-title">
                    <h1><i class="fas fa-fire"></i> Trending Products</h1>
                </div>

            </div>
        </div>
        <?php
        $products = \App\Models\Product::whereStatus(1)->paginate(20);

        ?>


        <div class="row">
            @foreach($products as $product)
                <div class="col-md-3">

                    <div class="product-item">
                        <a href="{!! route('productDetail',$product->sku) !!}">
                            <div class="product-thumb"
                                 style="background: url({!! asset('uploads/'.$product->photo) !!})"></div>
                        </a>

                        <div class="product-desc">
                            <h3 class="product-title">{!! $product->names !!}</h3>
                            <div class="row">
                                <h5 class="price">ប្រភេទ៖ <span>{!! $product->category->names !!}</span></h5>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <h5 class="price">តម្លៃ៖ <span>{!! $product->price !!}</span></h5>

                                </div>
                                <div class="col text-right">
                                    <p class="text-end seller">
                                        <a href="{!! route('sellerProfile',str_replace(' ','_',optional($product->seller)->full_name)) !!}">
                                            <i class="far fa-user"></i><span> {!! optional($product->seller)->full_name !!}</span>
                                        </a>
                                    </p></div>
                            </div>
                            <a href="{!! route('addCart',['id'=>$product->id,'buy_now'=>1]) !!}" type="button" class="btn add-cart w-100"><i
                                    class="fas fa-cart-plus"></i>
                                Buy Now
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</div>
