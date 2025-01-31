<x-app-layout>
    <div class="container">
        <div class="post-product-container">

            <div class="row">
                <div class="col-md-12 float-end">
                    <a href="{!! route('seller-products.create') !!}" class="btn btn-primary "><i
                            class="fas fa-plus"></i> Add Product</a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Price</th>
                            <th>Warranty</th>
                            <th>#</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $product)

                            <tr>
                                <td width="10%">
                                    <div class="image-list-preview"
                                         style="background: url({!! asset('uploads/'.$product->photo) !!})"></div>
                                </td>
                                <td>{!! $product->names !!}</td>
                                <td>{!! $product->status !!}</td>
                                <td>{!! $product->price !!}</td>
                                <td>{!! $product->day_warranty !!}</td>
                                <td>
                                    <a href="{!! route('seller-products.edit',$product->id) !!}"
                                       class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
