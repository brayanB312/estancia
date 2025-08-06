document.addEventListener('DOMContentLoaded', function() {
  renderCart();
  updateCartContadorNavbar();

  // Manejar clic en botones "Agregar al carrito"
  document.addEventListener('click', function(e) {
    if (e.target.classList.contains('agregar-carrito')) {
      e.preventDefault();
      const productoId = e.target.getAttribute('data-id');
      const nombre = e.target.getAttribute('data-nombre') || '';
      const precio = parseFloat(e.target.getAttribute('data-precio')) || 0;
      const talla = e.target.getAttribute('data-talla') || '';
      const color = e.target.getAttribute('data-color') || '';
      const imagen = e.target.getAttribute('data-imagen') || '';
      agregarAlCarrito({id: productoId, nombre, precio, talla, color, imagen});
    }
  });
});

function agregarAlCarrito(producto) {
  let cart = getCart();
  const idx = cart.findIndex(item => item.id === producto.id && item.talla === producto.talla && item.color === producto.color);
  if (idx !== -1) {
    cart[idx].cantidad += 1;
  } else {
    cart.push({
      ...producto,
      cantidad: 1
    });
  }
  setCart(cart);
  renderCart();
  updateCartContadorNavbar();
  alert('Producto agregado al carrito');
}

function getCart() {
  const cart = localStorage.getItem('carrito');
  return cart ? JSON.parse(cart) : [];
}

function setCart(cart) {
  localStorage.setItem('carrito', JSON.stringify(cart));
}

function renderCart() {
  const cart = getCart();
  const cartList = document.getElementById('cart-items-list');
  const cartCount = document.querySelector('.cart-count');
  const subtotalDiv = document.getElementById('cart-subtotal');
  const taxDiv = document.getElementById('cart-tax');
  const totalDiv = document.getElementById('cart-total');
  const cartContador = document.getElementById('cart_contador');

  let subtotal = 0;
  let totalItems = 0;

  if (cartList) {
    cartList.innerHTML = '';
    if (cart.length === 0) {
      cartList.innerHTML = '<p>El carrito está vacío.</p>';
    } else {
      cart.forEach((item, idx) => {
        subtotal += item.precio * item.cantidad;
        totalItems += item.cantidad;
        const article = document.createElement('article');
        article.className = 'cart-item';
        // Si la imagen es relativa y no empieza con '/' o 'http', prepende la ruta base
        let imagenSrc = item.imagen && item.imagen.trim() !== '' ? item.imagen : 'assets/images/logo.webp';
        if (imagenSrc && !imagenSrc.startsWith('/') && !imagenSrc.startsWith('http')) {
          imagenSrc = '/' + imagenSrc;
        }
        article.innerHTML = `
          <img src="${imagenSrc}" alt="${item.nombre}" />
          <div class="item-info">
            <div class="item-name">${item.nombre}</div>
            <div class="item-details">Talla: ${item.talla || '-'} &nbsp;|&nbsp; Color: ${item.color || '-'}</div>
            <div class="quantity-control">
              <button aria-label="Disminuir cantidad" onclick="updateQuantity(${idx}, -1)">−</button>
              <input type="text" readonly value="${item.cantidad}" aria-label="Cantidad de ${item.nombre}" />
              <button aria-label="Aumentar cantidad" onclick="updateQuantity(${idx}, 1)">+</button>
            </div>
          </div>
          <div class="item-price">
            $${(item.precio * item.cantidad).toFixed(2)}
            <small>$${item.precio.toFixed(2)} c/u</small>
          </div>
          <div class="remove-item" title="Eliminar artículo" onclick="removeItem(${idx})">🗑️</div>
        `;
        cartList.appendChild(article);
      });
    }
  } else {
    // Si no hay lista de carrito, igual contamos los items
    cart.forEach(item => {
      totalItems += item.cantidad;
      subtotal += item.precio * item.cantidad;
    });
  }

  if (cartCount) cartCount.textContent = `${totalItems} artículo${totalItems === 1 ? '' : 's'}`;
  if (cartContador) cartContador.textContent = totalItems;
  if (subtotalDiv) subtotalDiv.textContent = `$${subtotal.toFixed(2)}`;
  const tax = subtotal * 0.10; // 10% impuestos
  if (taxDiv) taxDiv.textContent = `$${tax.toFixed(2)}`;
  if (totalDiv) totalDiv.textContent = `$${(subtotal + tax).toFixed(2)}`;
}

function updateCartContadorNavbar() {
  const cart = getCart();
  const cartContador = document.getElementById('cart_contador');
  let totalItems = 0;
  cart.forEach(item => { totalItems += item.cantidad; });
  if (cartContador) cartContador.textContent = totalItems;
}

window.updateQuantity = function(idx, delta) {
  const cart = getCart();
  if (!cart[idx]) return;
  cart[idx].cantidad += delta;
  if (cart[idx].cantidad < 1) cart[idx].cantidad = 1;
  setCart(cart);
  renderCart();
  updateCartContadorNavbar();
}

window.removeItem = function(idx) {
  const cart = getCart();
  cart.splice(idx, 1);
  setCart(cart);
  renderCart();
  updateCartContadorNavbar();
}

// Stripe Checkout integration

// Stripe Checkout integration desde cero

// Stripe Checkout paso por paso
document.addEventListener('DOMContentLoaded', function() {
  var checkoutForm = document.getElementById('checkout-form');
  if (checkoutForm) {
    checkoutForm.onsubmit = function(e) {
      e.preventDefault();
      console.log('[PASO 1] Submit iniciado');

      // 1. Obtener datos del carrito y dirección
      var carrito = localStorage.getItem('carrito');
      var calle = document.getElementById('direccion_calle')?.value.trim() || '';
      var numero = document.getElementById('direccion_numero')?.value.trim() || '';
      var colonia = document.getElementById('direccion_colonia')?.value.trim() || '';
      var ciudad = document.getElementById('direccion_ciudad')?.value.trim() || '';
      var estado = document.getElementById('direccion_estado')?.value.trim() || '';
      var cp = document.getElementById('direccion_cp')?.value.trim() || '';
      console.log('[PASO 2] Datos obtenidos:', {carrito, calle, numero, colonia, ciudad, estado, cp});

      // 2. Validaciones
      if (!carrito || carrito === '[]') {
        alert('El carrito está vacío');
        console.error('[ERROR] Carrito vacío');
        return;
      }
      if (!calle || !numero || !colonia || !ciudad || !estado || !cp) {
        alert('Por favor completa todos los campos de dirección.');
        console.error('[ERROR] Dirección incompleta', {calle, numero, colonia, ciudad, estado, cp});
        return;
      }
      console.log('[PASO 3] Validaciones OK');

      // 3. Guardar dirección en localStorage para success.html
      localStorage.setItem('direccion_calle', calle);
      localStorage.setItem('direccion_numero', numero);
      localStorage.setItem('direccion_colonia', colonia);
      localStorage.setItem('direccion_ciudad', ciudad);
      localStorage.setItem('direccion_estado', estado);
      localStorage.setItem('direccion_cp', cp);
      console.log('[PASO 4] Dirección guardada en localStorage');

      // 4. Preparar parámetros para el backend
      var params =
        'carrito=' + encodeURIComponent(carrito) +
        '&direccion_calle=' + encodeURIComponent(calle) +
        '&direccion_numero=' + encodeURIComponent(numero) +
        '&direccion_colonia=' + encodeURIComponent(colonia) +
        '&direccion_ciudad=' + encodeURIComponent(ciudad) +
        '&direccion_estado=' + encodeURIComponent(estado) +
        '&direccion_cp=' + encodeURIComponent(cp);
      console.log('[PASO 5] Params preparados:', params);

      // 5. Enviar datos al backend
      fetch('stripe_checkout.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: params
      })
      .then(function(res) {
        console.log('[PASO 6] Respuesta recibida, status:', res.status);
        if (!res.ok) {
          alert('Error en la respuesta del servidor: ' + res.status);
          console.error('[ERROR] HTTP status', res.status);
          return Promise.reject('HTTP status ' + res.status);
        }
        return res.json();
      })
      .then(function(data) {
        console.log('[PASO 7] Data recibida del backend:', data);
        if (data.id && data.id.startsWith('cs_')) {
          try {
            var stripe = Stripe('pk_test_51RsiACAJJRFMxL6dEQQ0IBJG57QkYeLWKd8A5KGxWkhPu44BUD3iHOOolKlCLVHxZQA41TNVl9ZuHOb5R8gCtIdd00H7f9FGH4');
            console.log('[PASO 8] Stripe session creada, redirigiendo...');
            stripe.redirectToCheckout({ sessionId: data.id });
          } catch (err) {
            alert('Error al inicializar Stripe: ' + err);
            console.error('[ERROR] Stripe init:', err);
          }
        } else {
          alert('Error con Stripe: ' + (data.error || 'Error desconocido'));
          console.error('[ERROR] Stripe response:', data);
        }
      })
      .catch(function(err) {
        alert('Error en la petición a stripe_checkout.php: ' + err);
        console.error('[ERROR] Fetch stripe_checkout.php:', err);
      });
    };
  }
});