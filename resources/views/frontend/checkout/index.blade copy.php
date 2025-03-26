<x-app-layout>
    <div class="container">
        <h1>Checkout</h1>

        <!-- Display cart items -->
        <div class="cart-items">
            @foreach($cart as $id => $item)
                <div class="cart-item">
                    <h3>{{ $item['name'] }}</h3>
                    <p>Quantity: {{ $item['quantity'] }}</p>
                    <p>Price: ${{ $item['price'] }}</p>
                    @if(!empty($item['variant_name']))
                        <p>Variant: {{ $item['variant_name'] }}</p>
                        <p>Size: {{ $item['variant_size'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Total Price -->
        <div class="total-price">
            <h3>Total: ${{ $total }}</h3>
        </div>

        <!-- Checkout Form -->
        <form action="{{ route('checkout.process') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>



            <div class="form-group">
                <label for="address">Shipping Address</label>
                <textarea name="address" id="address" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="payment_method">Payment Method</label>
                <select name="payment_method" id="payment_method" class="form-control" required>
                    <option value="credit_card">Credit Card</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery">Cash on Delivery</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Place Order</button>
        </form>
    </div>
</x-app-layout>
