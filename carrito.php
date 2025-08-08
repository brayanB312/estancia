<?php
include 'components/navbar.php';
include 'components/footer.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/carrito.css">
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>

<?php navbar() ?>

<div class="container">

  <section class="cart-items">
    <div class="cart-header">
      <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg"><circle cx="9" cy="21" r="1" /><circle cx="20" cy="21" r="1" /><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" /></svg>
      Carrito de Compras
      <span class="cart-count">0 artículos</span>
    </div>
    <div id="cart-items-list"></div>
  </section>

  <aside class="order-summary">
    <h2>Resumen del Pedido</h2>
    <div class="summary-row">
      <div>Subtotal</div>
      <div id="cart-subtotal">$0.00</div>
    </div>
    <div class="summary-row">
      <div>Envío</div>
      <div class="highlight">¡Gratis!</div>
    </div>
    <div class="summary-row">
      <div>Impuestos</div>
      <div id="cart-tax">$0.00</div>
    </div>

    <div class="divider"></div>

    <div class="summary-row" style="font-size: 1.3rem;">
      <div>Total</div>
      <div id="cart-total">$0.00</div>
    </div>

    <form id="checkout-form" style="margin-bottom:1em;">
      <div style="margin-bottom:0.5em;">
        <label for="cliente_nombre" style="display:block;">Nombre completo:</label>
        <input type="text" id="cliente_nombre" name="cliente_nombre" required style="width:100%;padding:8px;" placeholder="Nombre completo">
      </div>
      <div style="margin-bottom:0.5em;">
        <label for="cliente_email" style="display:block;">Correo electrónico:</label>
        <input type="email" id="cliente_email" name="cliente_email" required style="width:100%;padding:8px;" placeholder="Correo electrónico">
      </div>
      <div style="margin-bottom:0.5em;">
        <label for="direccion_calle" style="display:block;">Calle:</label>
        <input type="text" id="direccion_calle" name="direccion_calle" required style="width:100%;padding:8px;" placeholder="Calle">
      </div>
      <div style="margin-bottom:0.5em;">
        <label for="direccion_numero" style="display:block;">Número:</label>
        <input type="text" id="direccion_numero" name="direccion_numero" required style="width:100%;padding:8px;" placeholder="Número">
      </div>
      <div style="margin-bottom:0.5em;">
        <label for="direccion_colonia" style="display:block;">Colonia:</label>
        <input type="text" id="direccion_colonia" name="direccion_colonia" required style="width:100%;padding:8px;" placeholder="Colonia">
      </div>
      <div style="margin-bottom:0.5em;">
        <label for="direccion_ciudad" style="display:block;">Ciudad:</label>
        <input type="text" id="direccion_ciudad" name="direccion_ciudad" required style="width:100%;padding:8px;" placeholder="Ciudad">
      </div>
      <div style="margin-bottom:0.5em;">
        <label for="direccion_estado" style="display:block;">Estado:</label>
        <input type="text" id="direccion_estado" name="direccion_estado" required style="width:100%;padding:8px;" placeholder="Estado">
      </div>
      <div style="margin-bottom:1em;">
        <label for="direccion_cp" style="display:block;">Código Postal:</label>
        <input type="text" id="direccion_cp" name="direccion_cp" required style="width:100%;padding:8px;" placeholder="Código Postal">
      </div>
      <button class="btn-primary" id="stripe-checkout" type="submit">Pagar con Stripe</button>
    </form>
    <button class="btn-secondary">Continuar Comprando</button>
  </aside>

</div>
    
</body>
</html>
<script src="carrito.js"></script>