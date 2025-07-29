document.addEventListener('DOMContentLoaded', function() {
    // Manejar clic en botones "Agregar al carrito"
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('agregar-carrito')) {
            e.preventDefault();
            const productoId = e.target.getAttribute('data-id');
            agregarAlCarrito(productoId);
        }
    });

    function agregarAlCarrito(productoId) {
        const formData = new FormData();
        formData.append('producto_id', productoId);

        fetch('agregar_carrito.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Producto agregado al carrito');
                actualizarContadorCarrito();
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al agregar al carrito');
        });
    }

    function actualizarContadorCarrito() {
        fetch('obtener_carrito.php')
        .then(response => response.json())
        .then(data => {
            const contador = document.getElementById('cart_contador');
            if (contador) {
                contador.textContent = data.cantidad || '0';
            }
        });
    }

    actualizarContadorCarrito();
});