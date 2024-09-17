document.addEventListener('DOMContentLoaded', function() {
    const cartItemsContainer = document.getElementById('cart-items');
    const subtotalElement = document.getElementById('subtotal');
    const igvElement = document.getElementById('IGV');
    const totalElement = document.getElementById('total');
    const IGV_RATE = 0.08;

    function loadCartItems() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Tu carrito está vacío.</p>';
            subtotalElement.textContent = 'S/0.00';
            igvElement.textContent = 'S/0.00';
            totalElement.textContent = 'S/0.00';
            return;
        }

        let subtotal = 0;

        cart.forEach(producto => {
            const itemTotal = producto.price * producto.cantidad;
            subtotal += itemTotal;

            const cartItem = document.createElement('div');
            cartItem.className = 'd-flex justify-content-between align-items-center mb-3';
            cartItem.innerHTML = `
                <img src="${producto.image}" alt="${producto.name}" class="product-img">
                <div class="product-details">
                    <span class="product-name">${producto.name}</span>
                    <div class="product-quantity">
                        <button class="btn btn-outline-secondary btn-sm decrease-quantity" data-producto-id="${producto.id}">-</button>
                        <span class="mx-2">${producto.cantidad}</span>
                        <button class="btn btn-outline-secondary btn-sm increase-quantity" data-producto-id="${producto.id}">+</button>
                    </div>
                    <span class="product-total">S/${itemTotal.toFixed(2)}</span>
                    <button class="btn btn-outline-danger btn-sm remove-producto" data-producto-id="${producto.id}"><i class="bi bi-trash"></i></button>
                </div>
            `;

            cartItemsContainer.appendChild(cartItem);
        });

        const igv = subtotal * IGV_RATE;
        const total = subtotal + igv;

        subtotalElement.textContent = `S/${subtotal.toFixed(2)}`;
        igvElement.textContent = `S/${igv.toFixed(2)}`;
        totalElement.textContent = `S/${total.toFixed(2)}`;

        attachEventListeners();
    }

    function attachEventListeners() {
        document.querySelectorAll('.decrease-quantity').forEach(button => {
            button.addEventListener('click', () => {
                const productoId = button.getAttribute('data-producto-id');
                updateProductQuantity(productoId, -1);
            });
        });

        document.querySelectorAll('.increase-quantity').forEach(button => {
            button.addEventListener('click', () => {
                const productoId = button.getAttribute('data-producto-id');
                updateProductQuantity(productoId, 1);
            });
        });

        document.querySelectorAll('.remove-producto').forEach(button => {
            button.addEventListener('click', () => {
                const productoId = button.getAttribute('data-producto-id');
                removeProductFromCart(productoId);
            });
        });

        document.getElementById('paymentForm').addEventListener('submit', function(event) {
            event.preventDefault();
            processPayment();
        });
    }

    function updateProductQuantity(productoId, change) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const productIndex = cart.findIndex(producto => producto.id === productoId);

        if (productIndex !== -1) {
            cart[productIndex].cantidad += change;

            if (cart[productIndex].cantidad <= 0) {
                cart.splice(productIndex, 1);
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            loadCartItems();
        }
    }

    function removeProductFromCart(productoId) {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        cart = cart.filter(producto => producto.id !== productoId);
        localStorage.setItem('cart', JSON.stringify(cart));
        loadCartItems();
    }

    function processPayment() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];

        if (cart.length === 0) {
            alert('No hay productos en el carrito.');
            return;
        }

        const paymentData = { cart };

        fetch('process_payment.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(paymentData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.open(data.pdfUrl, '_blank');
            } else {
                alert('Ocurrió un error al procesar el pago: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Ocurrió un error al procesar el pago.');
        });
    }

    loadCartItems();
});
