<x-frontend-layout>
    <div class="content-wrap">
        <!-- Categories Section -->
        <div class="container">
            <div class="row">
                <div class="container-title">
                    <div class="loader-line"></div>
                    <h2>Categories</h2>
                    {{-- <p>Browse our top categories here to discover different food cuisines.</p> --}}
                </div>
            </div>
            <div class="row justify-content-start">
                @foreach($categories as $category)
                    <div class="col-md-2">
                        <div class="category-box {!! Route::current()->parameter('category') == $category->id ? 'category-box-active' : '' !!}">
                            <a href="{{ route('productCategory', $category->id) }}">
                                <div class="thumbnail"
                                     style="background: url('{{ asset( 'storage/'.$category->icon) }}'); background-size: cover; background-position: center;">
                                </div>
                                <h3>{{ $category->names }}</h3>
                                
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Food Menu Section -->
        <div class="container mt-5">
            <div class="row">
                <div class="container-title">
                    <div class="loader-line"></div>
                    <h2>FOOD MENU</h2>
                    {{-- <p>Browse our top food items here to discover different cuisines.</p> --}}
                </div>
            </div>
            <div class="row justify-content-start">
                @foreach($products as $product)

                    <div class="col-md-3 p-2">
                        <div class="food-menu-item">
                            <div class="food-menu-thumb"
                                 style="background: url({{ asset('storage/'.$product->photo) }})">
                            </div>

                            <h5{{ $product->names }}</h5>
                            <table>
                                <thead>
                                <tr>
                                    <th class="code">Code</th>
                                    <th class="text-center">SIZE</th>
                                    <th class="price">Price</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td class="code">R01</td>
                                    <td class="text-center">REGULAR</td>
                                    <td class="price">3.25USD</td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="row mt-2">
                                <div class="col">
                                    <span><i class="fas fa-tag"></i> {!! $product->category->names !!}</span>
                                </div>
                                <div class="col">
{{--                                   <button class="btn btn-outline-secondary btn-sm float-end"><i class="fas fa-cart-plus"></i> Add to cart</button>--}}
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-cart-plus"></i> Add to cart
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-frontend-layout>
