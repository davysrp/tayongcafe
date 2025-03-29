<section class="ftco-menu">
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-7 heading-section text-center ftco-animate">
                <h2 class="mb-4">ផលិតផល</h2>
            </div>
        </div>
        <div class="row d-md-flex">
            <div class="col-lg-12 ftco-animate p-md-5">
                <div class="row">

                    <!-- Category Tabs -->
                    <div class="col-md-12 nav-link-wrap mb-5">
                        <div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            <!-- Add an "All" tab to show all products -->
                            <a class="nav-link active" id="v-pills-all-tab" data-toggle="pill" href="#v-pills-all"
                                role="tab" aria-controls="v-pills-all" aria-selected="true">ទាំងអស់</a>
                            @foreach($categories as $category)
                                <a class="nav-link" id="v-pills-{{ $category->id }}-tab" data-toggle="pill"
                                    href="#v-pills-{{ $category->id }}" role="tab"
                                    aria-controls="v-pills-{{ $category->id }}"
                                    aria-selected="false">{{ $category->names }}</a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Products -->
                    <div class="col-md-12 d-flex align-items-left">
                        <div class="tab-content ftco-animate" id="v-pills-tabContent">
                            <!-- Tab pane for "All" products -->
                            <div class="tab-pane fade show active" id="v-pills-all" role="tabpanel"
                                aria-labelledby="v-pills-all-tab">
                                <div class="row">
                                    @foreach($products as $product)
                                        <div class="col-md-4 text-center mb-4 product" data-product-id="{{ $product->id }}"
                                            data-has-variants="{{ $product->productVariant->isNotEmpty() ? 'true' : 'false' }}"
                                            data-variants="{{ $product->productVariant->toJson() }}">
                                            <div class="menu-wrap">
                                                <a href="#" class="menu-img img mb-4"
                                                    style="background-image: url('{{ Storage::url('product/' . $product->photo) }}'); height: 300px; width: 300px;background-size: cover;"></a>
                                                <div class="text">
                                                    <h3><a href="#" class="menu-warp-name-product">{{ $product->names }}</a>
                                                    </h3>
                                                    <p>{{ $product->detail }}</p>
                                                    <p class="price"><span>{{ number_format($product->price, 2) }} $</span>
                                                    </p>
                                                    <p>
                                                        <input type="hidden" name="quantity" value="1">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <button type="button"
                                                            class="btn btn-primary buy-button">ដាក់ចូលកន្ត្រក</button>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Tab panes for individual categories -->
                            @foreach($categories as $category)
                                <div class="tab-pane fade" id="v-pills-{{ $category->id }}" role="tabpanel"
                                    aria-labelledby="v-pills-{{ $category->id }}-tab">
                                    <div class="row">
                                        @if($category->products->isNotEmpty())
                                            @foreach($category->products as $product)
                                                <div class="col-md-4 text-center mb-4 product" data-product-id="{{ $product->id }}"
                                                    data-has-variants="{{ $product->productVariant->isNotEmpty() ? 'true' : 'false' }}"
                                                    data-variants="{{ $product->productVariant->toJson() }}">
                                                    <div class="menu-wrap">
                                                        <a href="#" class="menu-img img mb-4"
                                                            style="background-image: url('{{ Storage::url('product/' . $product->photo) }}'); height: 300px; width: 300px;background-size: cover;"></a>

                                                        <div class="text">
                                                            <h3><a href="#" class="menu-warp-name-product">{{ $product->names }}</a>
                                                            </h3>
                                                            <p>{{ $product->detail }}</p>
                                                            <p class="price"><span>{{ number_format($product->price, 2) }} $</span>
                                                            </p>
                                                            <p>
                                                                <input type="hidden" name="quantity" value="1">
                                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                                <button type="button"
                                                                    class="btn btn-primary buy-button">ដាក់ចូលកន្ត្រក</button>
                                                            </p>
                                                        </div>

                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="col-md-12 text-center">
                                                {{-- <p>No products available in this category.</p> --}}
                                                <p>ផលិតផលអស់ពីស្តុក</p>
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
        <div class="modal-content"
            style="background-color: black; color: #fff; font-family: 'Khmer OS Siemreap', sans-serif;">
            <div class="modal-header">
                <h5 class="modal-title" style="font-size: 24px; font-weight: normal;">ជ្រើសរើសតាមប្រភេទ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="color: #fff; font-size: 24px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="variantButtonsContainer">
                    <!-- Buttons will be dynamically added here -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"
                    style="font-size: 18px;">បិទ</button>
                <button type="button" class="btn btn-primary" id="confirmVariant"
                    style="font-size: 18px;">បញ្ជាក់</button>
            </div>
        </div>
    </div>
</div>


<script src="{{ asset('assets/js/script.js') }}"></script>



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const variantModal = new bootstrap.Modal(document.getElementById('variantModal'));
        const confirmVariant = document.getElementById('confirmVariant');
        let selectedProductId = null;
        let selectedVariantId = null;  // Stores the selected variant

        // Handle "Buy" button click
        document.querySelectorAll('.buy-button').forEach(button => {
            button.addEventListener('click', function (event) {
                event.preventDefault();

                const product = this.closest('.product');
                const hasVariants = product.dataset.hasVariants === 'true';
                selectedProductId = product.dataset.productId;

                if (hasVariants) {
                    // Get the variants for the selected product
                    const variants = JSON.parse(product.dataset.variants || '[]');
                    populateVariantButtons(variants);  // Populate variant options dynamically
                    selectedVariantId = null;  // Reset variant selection when opening modal
                    variantModal.show();
                } else {
                    // If no variants, add product directly to cart
                    addToCart(selectedProductId, null);
                }
            });
        });

        // Handle Confirm button in the modal
        confirmVariant.addEventListener('click', function () {
            if (selectedVariantId === null) {
                alert('សូមជ្រើសរើសប្រភេទខាងក្រោម');
                return;
            }

            // Add the selected variant to the cart
            addToCart(selectedProductId, selectedVariantId);
            variantModal.hide();  // Close the modal
        });

        // Populate variant buttons dynamically
        function populateVariantButtons(variants) {
            const container = document.getElementById('variantButtonsContainer');
            container.innerHTML = '';  // Clear any existing buttons

            variants.forEach(variant => {
                const button = document.createElement('button');
                button.type = 'button';
                button.className = 'btn btn-outline-light btn-block text-left variant-btn';
                button.style.marginBottom = '10px';
                button.dataset.variantId = variant.id;

                // Include variant size (e.g., 250ml, 500ml)
                const sizeText = variant.variant_size ? `(${variant.variant_size})` : '';
                button.innerHTML = `<span style="font-weight: normal;">${variant.variant_name}</span> ${sizeText} - $${variant.variant_price}`;

                button.addEventListener('click', () => {
                    selectVariant(button);
                });

                container.appendChild(button);
            });
        }

        // Highlight selected variant button and store selectedVariantId
        function selectVariant(button) {
            selectedVariantId = button.dataset.variantId;

            // Remove highlight from all variant buttons
            document.querySelectorAll('.variant-btn').forEach(btn => {
                btn.classList.remove('btn-success');
                btn.classList.add('btn-outline-light');
            });

            // Highlight the selected variant button
            button.classList.remove('btn-outline-light');
            button.classList.add('btn-success');
        }

        // Function to add product to cart via AJAX
        function addToCart(productId, variantId) {
            const formData = new FormData();
            formData.append('product_id', productId);
            formData.append('quantity', 1);  // Default quantity is 1

            if (variantId) {
                formData.append('variant_id', variantId);  // Only include variant_id if selected
            }

            console.log('Adding to cart: Product ID:', productId, 'Variant ID:', variantId);

            fetch('{{ route('cart.add') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    console.log('Server Response:', data);  // Log the server response
                    if (data.success) {
                        alert('Product added to cart successfully!');
                        // window.location.href = "{{ route('cart.index') }}";  // Redirect to the cart page
                    } else {
                        alert('Failed to add product to cart: ' + data.message);
                    }
                })
                // .catch(error => {
                //     console.error('Error:', error);
                //     alert('អ្នកមិនទាន់បាន Log in គណនី.');
                // });

                
                .catch(error => {
                    console.error('Error:', error);
                    window.location.href = "{{ route('memberFormLogin') }}";
                });


        }
    });

</script>