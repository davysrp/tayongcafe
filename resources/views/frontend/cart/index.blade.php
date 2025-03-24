<x-app-layout>
    <div class="container py-5">
        <h2 class="mb-4 text-dark"><i class="fas fa-cart-plus"></i> Cart List</h2>

        <div class="card shadow-sm p-4 bg-white rounded">
            <div class="table-responsive">
                <table class="table table-bordered align-middle text-center cart-table">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp

                        @if(session('cart') && is_array(session('cart')))
                            @foreach(session('cart') as $id => $item)
                                @php
                                    $subtotal = $item['price'] * $item['quantity'];
                                    $total += $subtotal;
                                @endphp
                                <tr data-id="{{ $id }}">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-start">
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/product/' . $item['photo']) }}"
                                                 alt="{{ $item['name'] }}"
                                                 class="product-thumb me-3">
                                            <div>
                                                <strong>{{ $item['name'] }}</strong><br>
                                                @if(!empty($item['variant_name']))
                                                    <small class="text-muted">Variant: {{ $item['variant_name'] }}</small><br>
                                                    <small class="text-muted">Size: {{ $item['variant_size'] ?? '' }}</small>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>${{ number_format($item['price'], 2) }}</td>
                                    <td>
                                        <div class="qty-wrapper d-inline-flex align-items-center">
                                            <button class="qty-btn btn-minus text-primary fw-bold" data-type="minus" data-id="{{ $id }}">−</button>
                                            <input type="text" id="quantity-{{ $id }}" class="qty-input text-center" value="{{ $item['quantity'] }}" readonly>
                                            <button class="qty-btn btn-plus text-primary fw-bold" data-type="plus" data-id="{{ $id }}">+</button>
                                        </div>
                                    </td>
                                    <td>$<span id="subtotal-{{ $id }}">{{ number_format($subtotal, 2) }}</span></td>
                                    


                                    <td class="text-center">
                                        <button type="button"
                                        class="btn-delete open-confirm-delete"
                                        data-id="{{ $id }}"
                                        data-url="{{ route('cart.remove') }}">
                                    <img src="{{ asset('assets/img/delete.png') }}" width="30" height="30" alt="Delete">

                                </button>

                                </td>
                                    
                                    
                                    
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="6">Your cart is empty.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <div class="text-end mt-3">
            <h5><strong>Total:</strong> $<span id="total-amount">{{ number_format($total, 2) }}</span></h5>
            <a href="{{ route('checkout') }}" class="btn btn-success">Proceed to Checkout</a>
        </div>
    </div>

    @push('scripts')
    
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- In your layout or Blade file -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    @endpush
</x-app-layout>
