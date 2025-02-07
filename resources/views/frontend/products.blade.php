<x-app-layout>

    <div class="container">
        <div class="product-wrap">

            <div class="row">
                <div class="col-md-12">
                    <div class="trending-title">
                        <h1><i class="fas fa-fire"></i> Products</h1>
                    </div>

                </div>
            </div>


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
                                    <h5 class="price">ប្រភេទ៖ <a href="{!! route('productList',['category'=>$product->category_id]) !!}"> <span>{!! $product->category->names !!}</span></a></h5>
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <h5 class="price">តម្លៃ៖ <span>{!! $product->price !!}</span></h5>
                                    </div>
                                    <div class="col text-right"><p class="text-end seller">
                                            <a href="{!! route('sellerProfile',$product->seller_id) !!}">
                                                <i class="far fa-user"></i><span> {!! optional($product->seller)->full_name !!}</span>
                                            </a>
                                        </p></div>
                                </div>
                                <a href="{!! route('addCart',$product->id) !!}" type="button" class="btn add-cart w-100"><i class="fas fa-cart-plus"></i>
                                    ដាក់ចូលកន្ត្រក
                                </a>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>

            <div class="mt-3">
                {{--<nav aria-label="Page navigation example ">
                    <ul class="pagination">
                        <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">Next</a></li>
                    </ul>
                </nav>--}}

                {{ $products->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
