<x-frontend-layout>
    <div class="content-wrap">
        <div class="container">
            <div class="row">
                <div class="container-title">
                    <div class="loader-line"></div>
                    <h2>Categories</h2>
                    <p>Browse out top categories here to discover different food cuision.</p>
                </div>
            </div>
            <div class="row justify-content-start">
                @foreach($categories as $category)
                    <div class="col-md-2">
                        <div class="category-box {!! Route::current()->parameter('category')==$category->id? 'category-box-active': '' !!}">
                            <a href="{!! route('productCategory',$category->id) !!}">
                                <div class="thumbnail"
                                     style="background: url(https://angular.pixelstrap.net/zomo/assets/images/product/p-1.png)"></div>
                                <h3>{!! $category->names !!}</h3>
{{--                                <div class="divider"></div>--}}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="container-title">
                    <div class="loader-line"></div>
                    <h2>FOOD MENU</h2>
                    <p>Browse out top categories here to discover different food cuision.</p>
                </div>
            </div>
            <div class="row justify-content-start">
                @foreach($products as $product)
                    <div class="col-md-3 p-2">
                        <div class="food-menu-item">
                            <div class="food-menu-thumb"
                                 style="background: url(https://dpubcafe.com//storage/photos/4/r1.jpg)">
                            </div>

                            <h5>R01-Ayam Penyet<span style="color:#d18c14">/</span> បាយមាន់ចៀនគ្រឿងពិសេស</h5>
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
