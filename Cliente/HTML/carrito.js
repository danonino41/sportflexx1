document.addEventListener('DOMContentLoaded', function() {
    const IGVRate = 0.08;

    function updateTotals() {
        let subtotal = 0;
        document.querySelectorAll('.producto-total').forEach(function(totalElement) {
            const totalText = totalElement.textContent.replace('S/', '').trim();
            const totalValue = parseFloat(totalText);
            if (!isNaN(totalValue)) {
                subtotal += totalValue;
            }
        });
        const IGV = subtotal * IGVRate;
        const total = subtotal + IGV;

        document.getElementById('subtotal').textContent = `S/${subtotal.toFixed(2)}`;
        document.getElementById('IGV').textContent = `S/${IGV.toFixed(2)}`;
        document.getElementById('total').textContent = `S/${total.toFixed(2)}`;
    }

    function updateProductoTotal(productoRow) {
        const cantidadElement = productoRow.querySelector('.cantidad');
        const cantidad = parseInt(cantidadElement.dataset.cantidad);
        const price = parseFloat(productoRow.dataset.productoPrice);
        const newTotal = (price * cantidad).toFixed(2);
        productoRow.querySelector('.producto-total').textContent = `S/${newTotal}`;
    }

    function loadCartItems() {
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        const cartItemsContainer = document.getElementById('cart-items');
        cartItemsContainer.innerHTML = '';

        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Tu carrito está vacío.</p>';
            subtotalElement.textContent = 'S/0.00';
            igvElement.textContent = 'S/0.00';
            totalElement.textContent = 'S/0.00';
            return;
        }

        let subtotal = 0;

        cart.forEach(function(producto) {
            const productoRow = document.createElement('div');
            productoRow.className = 'row py-3 align-items-center';
            productoRow.setAttribute('data-producto-id', producto.id);
            productoRow.setAttribute('data-producto-price', producto.price);

            productoRow.innerHTML = `
                <div class="col-md-4 d-flex align-items-center">
                    <img src="${producto.image}" alt="${producto.name}" class="producto-img me-3 img-thumbnail" style="width: 150px; height: 150px;" />
                    <div>${producto.name}</div>
                </div>
                <div class="col-md-4 d-flex align-items-center">
                    <button class="btn btn-outline-secondary decrease-cantidad">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                        </svg>
                    </button>
                    <div class="mx-3 cantidad" data-cantidad="${producto.cantidad}">${producto.cantidad}</div>
                    <button class="btn btn-outline-secondary increase-cantidad">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="M12 5v14"></path>
                        </svg>
                    </button>
                </div>
                <div class="col-md-4 d-flex align-items-center justify-content-end">
                    <div class="producto-total">S/${(producto.price * producto.cantidad).toFixed(2)}</div>
                    <button class="btn btn-outline-danger ms-3 remove-producto">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 6h18"></path>
                            <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"></path>
                            <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"></path>
                        </svg>
                    </button>
                </div>
            `;

            cartItemsContainer.appendChild(productoRow);
        });

        attachEventListeners();
        updateTotals();
    }

    function attachEventListeners() {
        document.querySelectorAll('.increase-cantidad').forEach(function(button) {
            button.addEventListener('click', function() {
                const productoRow = this.closest('[data-producto-id]');
                const cantidadElement = productoRow.querySelector('.cantidad');
                let cantidad = parseInt(cantidadElement.dataset.cantidad);
                cantidad++;
                cantidadElement.dataset.cantidad = cantidad;
                cantidadElement.textContent = cantidad;

                const productoId = productoRow.getAttribute('data-producto-id');
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                let producto = cart.find(p => p.id === productoId);
                producto.cantidad = cantidad;
                localStorage.setItem('cart', JSON.stringify(cart));

                updateProductoTotal(productoRow);
                updateTotals();
            });
        });

        document.querySelectorAll('.decrease-cantidad').forEach(function(button) {
            button.addEventListener('click', function() {
                const productoRow = this.closest('[data-producto-id]');
                const cantidadElement = productoRow.querySelector('.cantidad');
                let cantidad = parseInt(cantidadElement.dataset.cantidad);
                if (cantidad > 1) {
                    cantidad--;
                    cantidadElement.dataset.cantidad = cantidad;
                    cantidadElement.textContent = cantidad;

                    const productoId = productoRow.getAttribute('data-producto-id');
                    let cart = JSON.parse(localStorage.getItem('cart')) || [];
                    let producto = cart.find(p => p.id === productoId);
                    producto.cantidad = cantidad;
                    localStorage.setItem('cart', JSON.stringify(cart));

                    updateProductoTotal(productoRow);
                    updateTotals();
                }
            });
        });

        document.querySelectorAll('.remove-producto').forEach(function(button) {
            button.addEventListener('click', function() {
                const productoRow = this.closest('[data-producto-id]');
                const productoId = productoRow.getAttribute('data-producto-id');
                let cart = JSON.parse(localStorage.getItem('cart')) || [];
                cart = cart.filter(producto => producto.id !== productoId);
                localStorage.setItem('cart', JSON.stringify(cart));
                productoRow.remove();
                updateTotals();
            });
        });
    }

    loadCartItems();

    // Handle payment form submission
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        event.preventDefault();

        const cardNumber = document.getElementById('cardNumber').value;
        const expiryDate = document.getElementById('expiryDate').value;
        const cvv = document.getElementById('cvv').value;
        const total = document.getElementById('total').textContent.replace('S/', '').trim();

        if (cardNumber && expiryDate && cvv) {
            // Prepare data to send to the server
            const data = {
                cardNumber: cardNumber,
                expiryDate: expiryDate,
                cvv: cvv,
                total: total,
                cart: JSON.parse(localStorage.getItem('cart')) || []
            };

            // Send data to the server using fetch API
            fetch('process_payment.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(result => {
                console.log(result); // Agregar esta línea para depuración
                if (result.success) {
                    alert('Pago procesado exitosamente. Su boleta será generada.');
                    // Clear the cart
                    localStorage.removeItem('cart');
                    // Redirect to the generated PDF (or another confirmation page)
                    window.location.href = result.pdfUrl;
                } else {
                    alert('Hubo un problema al procesar el pago: ' + result.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error al procesar el pago.');
            });
        } else {
            alert('Por favor, completa todos los campos del formulario.');
        }
    });
});
