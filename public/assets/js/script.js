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


document.addEventListener('DOMContentLoaded', () => {
    const quantityButtons = document.querySelectorAll('.qty-btn');

    quantityButtons.forEach(button => {
        button.addEventListener('click', event => {
            event.preventDefault();

            const id = button.dataset.id;
            const input = document.getElementById('quantity-' + id);
            let qty = parseInt(input.value);

            if (button.dataset.type === 'minus' && qty > 1) {
                qty--;
            }

            if (button.dataset.type === 'plus' && qty < 99) {
                qty++;
            }

            input.value = qty;

            // Update subtotal
            const price = parseFloat(
                document.querySelector(`tr[data-id="${id}"] td:nth-child(3)`).textContent.replace('$', '')
            );
            const subtotal = (qty * price).toFixed(2);
            document.getElementById('subtotal-' + id).textContent = subtotal;

            // Update total
            let total = 0;
            document.querySelectorAll('span[id^="subtotal-"]').forEach(el => {
                total += parseFloat(el.textContent);
            });
            document.getElementById('total-amount').textContent = total.toFixed(2);
        });
    });

    // Update button AJAX
    document.querySelectorAll('.update-cart').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const quantity = document.getElementById('quantity-' + id).value;

            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ id, quantity })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    document.getElementById('subtotal-' + id).textContent = data.newSubtotal.toFixed(2);
                    document.getElementById('total-amount').textContent = data.newTotal.toFixed(2);
                }
            });
        });
    });

    // Delete confirm
    document.querySelectorAll('.open-confirm-delete').forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            event.stopPropagation();

            const id = this.dataset.id;
            const url = this.dataset.url;

            if (confirm('Are you sure you want to remove this item?')) {
                fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success) {
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        if (row) row.remove();

                        document.getElementById('total-amount').textContent = data.newTotal.toFixed(2);
                    }
                });
            }
        });
    });
});

