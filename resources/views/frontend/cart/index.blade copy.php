<x-app-layout>
    <div class="container">
        <div class="product-wrap">
            <div class="row">
                <div class="col-md-8">
                    <div class="trending-title">
                        <h1><i class="fas fa-cart-plus"></i> Cart List</h1>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr class="text-center">
                                <th>ល.រ</th>
                                <th>ឈ្មោះផលិតផល</th>
                                <th>តម្លៃ</th>
                                <th>ចំនួន</th>
                                <th>ចំនួនសរុប</th>
                                <th>សកម្មភាព</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0;
                                $i = 1;
                            @endphp

                            @if(session('cart') && is_array(session('cart')))
                            @foreach(session('cart') as $id => $details)
                                <tr data-id="{{ $id }}">
                                    <td align="center">{{ $loop->iteration }}</td>
                                    <td data-th="Product" align="center">
                                        <div class="row product-cart">
                                            <div class="col-sm-4 hidden-xs">
                                                <div class="cart-thumb"
                                                     style="background: url({{ isset($details['photo']) ? asset('uploads/'.$details['photo']) : '' }})">
                                                </div>
                                            </div>
                                            <div class="col-sm-8 text-start">
                                                <p class="nomargin">{{ $details['name'] }}</p>
                                                @if(!empty($details['variant_name']))
                                                    <p><small>Variant: {{ $details['variant_name'] }}</small></p>
                                                    <p><small>Size: {{ $details['variant_size'] }}</small></p>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td data-th="Price" align="center">${{ $details['price'] }}</td>
                                    <td data-th="Quantity" align="center" width="25%">
                                        <div class="input-group">
                                            <button type="button" class="btn btn-outline-secondary btn-sm btn-number"
                                                data-type="minus" data-id="{{ $id }}" data-field="quantity">
                                                <span class="fa fa-minus"></span>
                                            </button>
                                            <input type="text" id="quantity-{{ $id }}" class="form-control form-control-sm input-number text-center"
                                                   value="{{ $details['quantity'] }}" min="1" max="10">
                                            <button type="button" class="btn btn-outline-secondary btn-sm btn-number"
                                                data-type="plus" data-id="{{ $id }}" data-field="quantity">
                                                <span class="fa fa-plus"></span>
                                            </button>
                                        </div>
                                    </td>
                                    <td data-th="Subtotal" align="center">
                                        $<span id="subtotal-{{ $id }}">{{ $details['price'] * $details['quantity'] }}</span>
                                    </td>
                                    <td class="actions" align="center">
                                        <button type="button" class="btn btn-danger btn-sm remove-from-cart"
                                            data-id="{{ $id }}"
                                            data-url="{{ route('cart.remove') }}">
                                            លុប
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="6" align="center">Your cart is empty.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 offset-md-4">
                    <div class="total-price">
                        <h4>Total: ${{ $total }}</h4>
                        <a href="{{ route('checkout') }}" class="btn btn-success">យល់ព្រមទិញ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Update quantity
            document.querySelectorAll('.btn-number').forEach(button => {
                button.addEventListener('click', function() {
                    const type = this.dataset.type;
                    const id = this.dataset.id;
                    const quantityInput = document.getElementById('quantity-' + id);
                    let currentQuantity = parseInt(quantityInput.value);

                    if (type === 'minus' && currentQuantity > 1) {
                        currentQuantity--;
                    } else if (type === 'plus' && currentQuantity < 10) {
                        currentQuantity++;
                    }

                    quantityInput.value = currentQuantity;

                    // Send AJAX request to update cart
                    fetch('{{ route('cart.update') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        },
                        body: JSON.stringify({ id, quantity: currentQuantity }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update subtotal
                            document.getElementById('subtotal-' + id).textContent = data.newSubtotal;
                            // Update total
                            document.querySelector('.total-price h4').textContent = 'Total: $' + data.newTotal;
                        } else {
                            alert('Failed to update cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
                });
            });

            // Remove item from cart
            document.querySelectorAll('.remove-from-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    const url = this.dataset.url; // Use the URL directly from button data attribute

                    fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ id }),
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.success) {
                            const row = document.querySelector('tr[data-id="' + id + '"]');
                            if (row) {
                                row.remove();
                            }
                            document.querySelector('.total-price h4').textContent = 'Total: $' + data.newTotal;
                        } else {
                            alert('Failed to remove item from cart.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('An error occurred while removing the item.');
                    });
                });
            });
        </script>
    @endpush
</x-app-layout>
