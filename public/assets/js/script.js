function previewImage(event) {
    const input = event.target;
    const reader = new FileReader();

    reader.onload = function () {
        const preview = document.getElementById('profile-preview');
        preview.src = reader.result;
    }

    if (input.files && input.files[0]) {
        reader.readAsDataURL(input.files[0]);
    }
}




//Checkout 


// document.addEventListener('DOMContentLoaded', () => {
//     const quantityButtons = document.querySelectorAll('.qty-btn');

//     quantityButtons.forEach(button => {
//         button.addEventListener('click', event => {
//             event.preventDefault();

//             const id = button.dataset.id;
//             const input = document.getElementById('quantity-' + id);
//             let qty = parseInt(input.value);
//             if (button.dataset.type === 'minus' && qty > 1) {
//                 // qty--;
//                 qty = qty - 1
//             }

//             if (button.dataset.type === 'plus' && qty < 99) {
//                 qty = qty + 1
//                 // qty++;
//             }

//             input.value = qty;

//             // Update subtotal
//             const price = parseFloat(
//                 document.querySelector(`tr[data-id="${id}"] td:nth-child(3)`).textContent.replace('$', '')
//             );
//             const subtotal = (qty * price).toFixed(2);
//             document.getElementById('subtotal-' + id).textContent = subtotal;

//             // Update total
//             let total = 0;
//             document.querySelectorAll('span[id^="subtotal-"]').forEach(el => {
//                 total += parseFloat(el.textContent);
//             });
//             document.getElementById('total-amount').textContent = total.toFixed(2);
//         });
//     });

//     // Update button AJAX
//     document.querySelectorAll('.update-cart').forEach(button => {
//         button.addEventListener('click', () => {
//             const id = button.dataset.id;
//             const quantity = document.getElementById('quantity-' + id).value;

//             // fetch('/cart/update', {
//             //     method: 'POST',
//             //     headers: {
//             //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//             //         'Content-Type': 'application/json'
//             //     },
//             //     body: JSON.stringify({ id, quantity })
//             // })
//             // .then(res => res.json())
//             // .then(data => {
//             //     if (data.success) {
//             //         document.getElementById('subtotal-' + id).textContent = data.newSubtotal.toFixed(2);
//             //         document.getElementById('total-amount').textContent = data.newTotal.toFixed(2);
//             //     }
//             // });


//             // Send update to server immediately
//             fetch('/cart/update', {
//                 method: 'POST',
//                 headers: {
//                     'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                     'Content-Type': 'application/json'
//                 },
//                 body: JSON.stringify({ id, quantity: qty })
//             })
//                 .then(res => res.json())
//                 .then(data => {
//                     if (data.success) {
//                         document.getElementById('subtotal-' + id).textContent = data.newSubtotal.toFixed(2);
//                         document.getElementById('total-amount').textContent = data.newTotal.toFixed(2);
//                     }
//                 });


//         });
//     });

//     // Delete confirm
//     document.querySelectorAll('.open-confirm-delete').forEach(button => {
//         button.addEventListener('click', function (event) {
//             event.preventDefault();
//             event.stopPropagation();

//             const id = this.dataset.id;
//             const url = this.dataset.url;

//             if (confirm('Are you sure you want to remove this item?')) {
//                 fetch(url, {
//                     method: 'POST',
//                     headers: {
//                         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
//                         'Content-Type': 'application/json'
//                     },
//                     body: JSON.stringify({ id })
//                 })
//                     .then(res => res.json())
//                     .then(data => {
//                         if (data.success) {
//                             const row = document.querySelector(`tr[data-id="${id}"]`);
//                             if (row) row.remove();

//                             document.getElementById('total-amount').textContent = data.newTotal.toFixed(2);
//                         }
//                     });
//             }
//         });
//     });
// });




    
document.addEventListener('DOMContentLoaded', function() {
    // Quantity update buttons
    document.querySelectorAll('.btn-number').forEach(function(btn) {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            
            const type = this.getAttribute('data-type');
            const field = this.getAttribute('data-field');
            const input = this.closest('.input-group').querySelector(`input[name="${field}"]`);
            let currentVal = parseInt(input.value);
            const min = parseInt(input.getAttribute('min'));
            const max = parseInt(input.getAttribute('max'));

            if (type === 'minus' && currentVal > min) {
                input.value = currentVal - 1;
            } else if (type === 'plus' && currentVal < max) {
                input.value = currentVal + 1;
            }
            
            // Trigger update if value changed
            if (input.value != currentVal) {
                updateCartItem(input.closest('form'));
            }
        });
    });

    // Manual quantity input change
    document.querySelectorAll('.input-number').forEach(function(input) {
        input.addEventListener('change', function() {
            updateCartItem(this.closest('form'));
        });
    });


    document.querySelectorAll('.remove-from-cart').forEach(btn => {
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            
            if (!confirm('Are you sure you want to remove this item?')) return;
    
            const id = this.dataset.id;
            const url = this.dataset.url;
            
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ id: id })
                });
    
                const data = await response.json();
                
                if (!data.success) {
                    throw new Error(data.message || 'Failed to remove item');
                }
    
                // 1. Remove the table row
                const row = this.closest('tr');
                if (row) row.remove();
                
                // 2. Update totals safely
                const grandTotalEl = document.querySelector('.grand-total');
                if (grandTotalEl) {
                    grandTotalEl.textContent = '$' + data.newTotal;
                }
                
                // 3. Update cart count if exists
                const cartCountEl = document.querySelector('.cart-count');
                if (cartCountEl) {
                    cartCountEl.textContent = data.cartCount || Object.keys(data.cart).length;
                }
                
                // 4. Show success message
                alert('Item removed successfully');
                
                // 5. Reload if cart is empty
                if (data.cartCount === 0 || Object.keys(data.cart).length === 0) {
                    location.reload();
                }
                
            } catch (error) {
                console.error('Error removing item:', error);
                alert('Error: ' + error.message);
            }
        });
    });



// Function to update cart item
function updateCartItem(form) {
    const formData = new FormData(form);
    const id = formData.get('id');
    const quantity = formData.get('quantity');
    
    // Convert to plain object
    const data = {
        id: id,
        quantity: quantity
    };

    fetch(form.action, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update UI
            const row = document.querySelector(`tr[data-id="${id}"]`);
            if (row) {
                row.querySelector('.subtotal').textContent = '$' + data.newSubtotal;
            }
            document.getElementById('cart-subtotal').textContent = data.newTotal;
            document.getElementById('grand-total').textContent = data.newTotal;
        } else {
            alert('Error: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error updating quantity');
    });
}

});
