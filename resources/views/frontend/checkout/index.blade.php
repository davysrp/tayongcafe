<x-app-layout>
    <div class="container py-5 text-light" style="background-color: #1c1c1c; border-radius: 10px;">
        <h1 class="mb-4 text-coffee">☕ Checkout</h1>

        <!-- Cart Items -->
        <div class="mb-5">
            <h4 class="mb-3 text-muted">🛒 Your Coffee Cart</h4>
            @forelse($cart as $id => $item)
                <div class="card mb-3 bg-dark text-light border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $item['name'] }}</h5>
                        <ul class="list-unstyled mb-0">
                            <li>📦 Quantity: <strong>{{ $item['quantity'] }}</strong></li>
                            <li>💰 Price: <strong>${{ number_format($item['price'], 2) }}</strong></li>
                            @if(!empty($item['variant_name']))
                                <li>☕ Variant: {{ $item['variant_name'] }} | Size: {{ $item['variant_size'] }}</li>
                            @endif
                        </ul>
                    </div>
                </div>
            @empty
                <p class="text-secondary">No items in your cart.</p>
            @endforelse
        </div>

        <!-- Total Price -->
        <div class="mb-5 text-end">
            <h4 class="fw-bold">Total: <span class="text-coffee">${{ number_format($total, 2) }}</span></h4>
        </div>

        <!-- Checkout Form -->
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <input type="hidden" name="customer_id" value="{{ $customer->id }}">

            <div class="row mb-4">
                <!-- Shipping -->
                <div class="col-md-6 mb-3">
                    <label for="shipping_method_id" class="form-label">🚚 Shipping Method</label>
                    <select name="shipping_method_id" id="shipping_method_id" class="form-select bg-dark text-light border-secondary" required>
                        <option value="" disabled selected>Choose a method</option>
                        @foreach($shippingMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Payment -->
                <div class="col-md-6 mb-3">
                    <label class="form-label">💳 Payment Method</label>
                    <div>
                        @foreach($paymentMethods as $item)
                            <div class="form-check form-check-inline me-3">
                                <input class="form-check-input" type="radio" name="payment_method_id"
                                       id="payment_{{ $item->id }}" value="{{ $item->id }}" required>
                                <label class="form-check-label text-light" for="payment_{{ $item->id }}">
                                    {{ $item->names }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-lg btn-coffee text-white px-4 shadow-sm">
                    🛍️ Place Order
                </button>
            </div>
        </form>
    </div>

    <style>
        .text-coffee {
            color: #d2a679;
        }

        .btn-coffee {
            background-color: #6f4e37;
            border: none;
        }

        .btn-coffee:hover {
            background-color: #5a3e2b;
        }

        .form-select:focus, .form-check-input:focus {
            box-shadow: 0 0 0 0.15rem rgba(210, 166, 121, 0.5);
            border-color: #d2a679;
        }
    </style>
</x-app-layout>
