<section class="ftco-menu">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2 class="mb-4">Products</h2>
            </div>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">
                    <!-- Category Tabs -->
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            <!-- Add an "All" tab to show all products -->
                            <a
                                class="nav-link active"
                                id="v-pills-all-tab"
                                data-toggle="pill"
                                href="#v-pills-all"
                                role="tab"
                                aria-controls="v-pills-all"
                                aria-selected="true">
                                All
                            </a>
                            @foreach($categories as $category)
                                <a
                                    class="nav-link"
                                    id="v-pills-{{ $category->id }}-tab"
                                    data-toggle="pill"
                                    href="#v-pills-{{ $category->id }}"
                                    role="tab"
                                    aria-controls="v-pills-{{ $category->id }}"
                                    aria-selected="false">
                                    {{ $category->names }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="col-md-12 d-flex align-items-left">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            <!-- Tab pane for "All" products -->
                            <div class="tab-pane fade show active" id="v-pills-all" role="tabpanel" aria-labelledby="v-pills-all-tab">
                                <div class="row">
                                    @foreach($categories as $category)
                                        @if($category->products->isNotEmpty())
                                            @foreach($category->products as $product)
                                            <div class="col-md-4 text-center mb-4 product" data-category="{{ $category->id }}" data-has-variants="{{ $product->variants && $product->variants->isNotEmpty() ? 'true' : 'false' }}" data-variants="{{ $product->variants ? $product->variants->toJson() : '[]' }}">
                                                    <div class="menu-wrap">
                                                        <a href="#" class="menu-img img mb-4" style="background-image: url('{{ Storage::url('product/' . $product->photo) }}'); height: 300px; width: 300px;background-size: cover;"></a>
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
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12 text-center">
                                                <p>No products available in this category.</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tab panes for individual categories -->
                            @foreach($categories as $category)
                                <div class="tab-pane fade" id="v-pills-{{ $category->id }}" role="tabpanel" aria-labelledby="v-pills-{{ $category->id }}-tab">
                                    <div class="row">
                                        @if($category->products->isNotEmpty())
                                            @foreach($category->products as $product)
                                            <div class="col-md-4 text-center mb-4 product" data-category="{{ $category->id }}" data-has-variants="{{ $product->variants && $product->variants->isNotEmpty() ? 'true' : 'false' }}" data-variants="{{ $product->variants ? $product->variants->toJson() : '[]' }}">
                                                    <div class="menu-wrap">
                                                        <a href="#" class="menu-img img mb-4" style="background-image: url('{{ Storage::url('product/' . $product->photo) }}'); height: 300px; width: 300px;background-size: cover;"></a>
                                                        <div class="text">
                                                            <h3><a href="#" class="menu-warp-name-product">{{ $product->names }}</a></h3>
                                                            <p>{{ $product->detail }}</p>
                                                            <p class="price"><span>{{ number_format($product->price,2) }} $</span></p>
                                                            <p>
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="button" class="btn btn-primary buy-button">Buy</button>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12 text-center">
                                                <p>No products available in this category.</p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Modal for selecting product variants -->
<div id="variantModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Variant</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="variantForm">
                    <div class="form-group">
                        <label for="variantSelect">Choose a variant:</label>
                        <select class="form-control" id="variantSelect">
                            <!-- Variant options will be populated here -->
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="console.log('Close button clicked')">Close</button>
                <button type="button" class="btn btn-primary" id="confirmVariant">Confirm</button>
            </div>
        </div>
    </div>
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabs = document.querySelectorAll('.nav-link');
        const products = document.querySelectorAll('.product');
        const variantModal = new bootstrap.Modal(document.getElementById('variantModal')); // Bootstrap 5 modal instance
        const variantSelect = document.getElementById('variantSelect');
        const confirmVariant = document.getElementById('confirmVariant');
        let currentProduct = null;

        // Function to handle "Add to Cart" button click
        function handleAddToCart(event) {
            console.log('Buy button clicked'); // Debugging
            event.preventDefault();
            const product = event.target.closest('.product');
            const hasVariants = product.dataset.hasVariants === 'true';
            const productId = product.querySelector('input[name="product_id"]').value;

            console.log('Product ID:', productId); // Debugging
            console.log('Has variants:', hasVariants); // Debugging

            if (hasVariants) {
                currentProduct = product;
                // Populate the variant select options
                const variants = JSON.parse(product.dataset.variants || '[]');
                console.log('Variants:', variants); // Debugging
                variantSelect.innerHTML = ''; // Clear existing options
                variants.forEach(variant => {
                    const option = document.createElement('option');
                    option.value = variant.id;
                    option.text = variant.name;
                    variantSelect.appendChild(option);
                });
                variantModal.show(); // Show the modal
            } else {
                // Add product to cart directly if no variants
                addToCart(productId, null);
            }
        }

        // Attach event listeners to "Buy" buttons
        document.querySelectorAll('.buy-button').forEach(button => {
            button.addEventListener('click', handleAddToCart);
        });

        // Handle confirm button click in the modal
        confirmVariant.addEventListener('click', function () {
            const selectedVariant = variantSelect.value;
            if (selectedVariant) {
                const productId = currentProduct.querySelector('input[name="product_id"]').value;
                addToCart(productId, selectedVariant);
                variantModal.hide(); // Hide the modal
            }
        });

        // Function to add product to cart via AJAX
        function addToCart(productId, variantId) {
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);
            if (variantId) {
                formData.append('variant_id', variantId);
            }

            fetch('/add-to-cart', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: 1,
                    variant_id: variantId, // Optional
                }),
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Product added to cart:', data); // Debugging
                } else {
                    console.error('Failed to add product to cart:', data.message); // Debugging
                }
            })
            .catch(error => {
                console.error('Error:', error); // Debugging
            });
        }

        // Handle tab switching (existing code)
        tabs.forEach(tab => {
            tab.addEventListener('click', function () {
                const target = this.getAttribute('aria-controls');
                if (target === 'v-pills-all') {
                    // Show all products
                    products.forEach(product => {
                        product.style.display = 'block';
                    });
                } else {
                    // Show only products of the selected category
                    const categoryId = target.replace('v-pills-', '');
                    products.forEach(product => {
                        if (product.getAttribute('data-category') === categoryId) {
                            product.style.display = 'block';
                        } else {
                            product.style.display = 'none';
                        }
                    });
                }
            });
        });


    });
</script>
