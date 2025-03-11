{{-- <div class="col-md-4 text-center mb-4 product" data-product-id="{{ $product->id }}" data-has-variants="{{ $product->productVariant->isNotEmpty() ? 'true' : 'false' }}" data-variants="{{ $product->productVariant->toJson() }}">
    <div class="menu-wrap">
        <a href="#" class="menu-img img mb-4" style="background-image: url('{{ Storage::url('product/' . $product->photo) }}'); height: 300px; width: 300px; background-size: cover;"></a>
        <div class="text">
            <h3><a href="#" class="menu-warp-name-product">{{ $product->names }}</a></h3>
            <p>{{ $product->detail }}</p>
            <p class="price"><span>{{ number_format($product->price, 2) }} $</span></p>
            <p>
                <input type="hidden" name="quantity" value="1">
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="button" class="btn btn-primary buy-button">Buy</button>
            </p>
        </div>
    </div>
</div> --}}
