document.addEventListener('DOMContentLoaded', () => {
    const listaCarrito = document.getElementById('lista-carrito');
    const totalElemento = document.getElementById('total');
    const botonVaciar = document.getElementById('vaciar-carrito');


    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

  
    function mostrarCarrito() {
        listaCarrito.innerHTML = ''; 
        let total = 0;

        if (carrito.length === 0) {
            listaCarrito.innerHTML = '<p>El carrito está vacío</p>';
            totalElemento.textContent = 'Total: $0.00';
            return;
        }

        carrito.forEach((producto, index) => {
            const subtotal = producto.precio * producto.cantidad;
            total += subtotal;

            const divProducto = document.createElement('div');
            divProducto.className = 'producto';
            divProducto.innerHTML = `
                <h3>${producto.nombre}</h3>
                <p>Precio: $${producto.precio}</p>
                <p>Cantidad: ${producto.cantidad}</p>
                <p>Subtotal: $${subtotal.toFixed(2)}</p>
                <button onclick="eliminarDelCarrito(${index})">Eliminar</button>
            `;
            listaCarrito.appendChild(divProducto);
        });

        totalElemento.textContent = `Total: $${total.toFixed(2)}`;
    }


    botonVaciar.addEventListener('click', () => {
        localStorage.removeItem('carrito');
        carrito = [];
        mostrarCarrito();
        alert('Carrito vaciado');
    });


    mostrarCarrito();
});


function eliminarDelCarrito(index) {
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
    carrito.splice(index, 1); 
    localStorage.setItem('carrito', JSON.stringify(carrito));
    location.reload(); 
}