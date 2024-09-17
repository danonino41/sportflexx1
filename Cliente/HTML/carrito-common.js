document.addEventListener('DOMContentLoaded', function() {
    const cartCountElement = document.getElementById('cart-count');

    function updateCartCount() {
        const cart = JSON.parse(localStorage.getItem('cart')) || [];
        const totalCount = cart.reduce((total, producto) => total + producto.cantidad, 0);
        cartCountElement.textContent = totalCount;
    }

    document.querySelectorAll('.add-to-cart').forEach(function(button) {
        button.addEventListener('click', function() {
            const productoId = this.getAttribute('data-producto-id');
            const productoName = this.getAttribute('data-producto-name');
            const productoPrice = this.getAttribute('data-producto-price');
            const productoImage = this.getAttribute('data-producto-image');

            let cart = JSON.parse(localStorage.getItem('cart')) || [];
            let existingProducto = cart.find(producto => producto.id === productoId);

            if (existingProducto) {
                existingProducto.cantidad += 1;
            } else {
                cart.push({ id: productoId, name: productoName, price: parseFloat(productoPrice), image: productoImage, cantidad: 1 });
            }

            localStorage.setItem('cart', JSON.stringify(cart));
            alert(`${productoName} ha sido añadido a tu carrito.`);
            updateCartCount();
        });
    });

    // Update cart count on page load
    updateCartCount();
});
