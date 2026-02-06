<?php
// ESTO ES LO NUEVO: Iniciamos sesión antes de cualquier HTML
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CM Shop - Tienda de Robux</title>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <?php include('header.php') ?>

  <section class="ventajas">
    <div class="ventaja">
      <div class="cajasimgindex"><img src="img/cohete.jpg" alt="Entrega rápida" class="ventaja-img"></div>
      <h3>Entrega Rápida</h3>
      <p>Recibe tus ROBUX al instante. Nuestro sistema asegura entregas en SEGUNDOS.</p>
    </div>
    <div class="ventaja">
      <div class="cajasimgindex"><img src="img/dinero.jpg" alt="Entrega rápida" class="ventaja-img"></div>
      <h3>Precios Increíbles</h3>
      <p>Consigue la mejor oferta: 1,000 Robux por solo $5.40.</p>
    </div>
    <div class="ventaja">
      <div class="cajasimgindex"><img src="img/seguro.jpg" alt="Entrega rápida" class="ventaja-img"></div>
      <h3>100% Seguro</h3>
      <p>Compra con total confianza. Usamos sistemas de pago seguros para tu tranquilidad.</p>
    </div>
  </section>

  <section class="cta">
    <h2>¿Listo para comprar Robux al mejor precio?</h2>
    <p>Haz tu compra ahora y consigue tus monedas con el mejor servicio.</p>
    <a href="productos.php" class="comprarahora">¡Comprar Ahora!</a>
  </section>
  <script type="text/javascript">
    var Tawk_API = Tawk_API || {},
      Tawk_LoadStart = new Date();
    (function() {
      var s1 = document.createElement("script"),
        s0 = document.getElementsByTagName("script")[0];
      s1.async = true;
      s1.src = 'https://embed.tawk.to/69402eb6b690c5197ee9d03c/1jchbcugh';
      s1.charset = 'UTF-8';
      s1.setAttribute('crossorigin', '*');
      s0.parentNode.insertBefore(s1, s0);
    })();
  </script>
</body>

</html>