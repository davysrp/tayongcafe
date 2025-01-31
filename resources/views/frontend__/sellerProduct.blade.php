<x-app-layout>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="profile-container">
                    <div class="profile-header">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="profile-icon"><i class="far fa-user"></i></div>
                            </div>
                            <div class="col-md-11">
                                <h4>{!! $seller->full_name !!}</h4>
                                <span class="member-tag"><i class="fas fa-at"></i> {!! $seller->username !!}</span><br>
                                <span
                                    class="member-tag">Member since {!! \Carbon\Carbon::parse($seller->created_at)->format('d/m/y') !!}</span>
                                <br>
                                <span class="phone-tag"><i class="fas fa-phone-alt"></i> {!! substr($seller->phone, 0, -3) . 'xxx' !!}</span>
                                <a href="{{route('frontend__.chatseller',['seller'=>$seller->id])}}" class="btn btn-chat"><i class="fab fa-rocketchat"></i> Chat Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="profile-search">

            {!! Form::open(['route'=>['sellerProfile',$seller->id],'method'=>'get']) !!}
            <div class="row">
                <div class="col-md-6">
                    {!! Form::text('search',null,['class'=>'form-control','placeholder'=>'Search...']) !!}
                </div>
                <div class="col-md-4">
                    {!! Form::select('category',$category,null,['class'=>'form-control','placeholder'=>'Category']) !!}
                </div>
                <div class="col-md-2">
                    {!! Form::submit('Search',['class'=>'btn btn-primary']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
        <div class="product-wrap">
            <div class="row">

                <div class="row">
                    <div class="col-md-12">
                        <div class="trending-title">
                            <h1><i class="fas fa-fire"></i> Products</h1>
                        </div>

                    </div>
                </div>
                <div class="row">
                    @if($products->count()>0)

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
                                                    <a href="{!! route('sellerProfile',str_replace(' ','_',optional($product->seller)->full_name)) !!}">
                                                        <i class="far fa-user"></i><span> {!! optional($product->seller)->full_name !!}</span>
                                                    </a>
                                                </p></div>
                                        </div>
                                        <a href="{!! route('addCart',['id'=>$product->id,'buy_now'=>1]) !!}" type="button" class="btn add-cart w-100"><i class="fas fa-cart-plus"></i>
                                            ដាក់ចូលកន្ត្រក
                                        </a>
                                    </div>
                                </div>

                            </div>
                        @endforeach


                    @else
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h5>Product not found!</h5>
                            </div>

                        </div>

                    @endif
                </div>
                <div class="mt-3">
                    {{ $products->links() }}
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
