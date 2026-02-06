<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('conexion.php');

$id_usuario_logeado = $_SESSION['usuario_id'] ?? 0;

if ($id_usuario_logeado == 0) {
    // Redirección segura con JS
    echo "<script>window.location.href='login.php';</script>";
    exit(); 
}

// AGREGAR AL CARRITO
if (isset($_POST['agregar']) && $id_usuario_logeado > 0) {
    $id_producto = intval($_POST['id']);
    
    $check = mysqli_query($conexion, "SELECT * FROM carrito WHERE usuario_id = $id_usuario_logeado AND producto_id = $id_producto");
    if (mysqli_num_rows($check) > 0) {
        mysqli_query($conexion, "UPDATE carrito SET cantidad = cantidad + 1 WHERE usuario_id = $id_usuario_logeado AND producto_id = $id_producto");
    } else {
        mysqli_query($conexion, "INSERT INTO carrito (usuario_id, producto_id, cantidad) VALUES ($id_usuario_logeado, $id_producto, 1)");
    }
    echo "<script>window.location.href='productos.php';</script>";
    exit();
}

// ELIMINAR DEL CARRITO
if (isset($_GET['eliminar'])) {
    $id_del = intval($_GET['eliminar']);
    mysqli_query($conexion, "DELETE FROM carrito WHERE usuario_id = $id_usuario_logeado AND producto_id = $id_del");
    echo "<script>window.location.href='productos.php';</script>";
    exit();
}

// CONSULTAS
$productos = mysqli_query($conexion, "SELECT * FROM productos");
$carrito = mysqli_query($conexion, "SELECT p.nombre, p.precio, c.cantidad, c.producto_id FROM carrito c JOIN productos p ON c.producto_id = p.id WHERE c.usuario_id = $id_usuario_logeado");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { font-family: sans-serif; padding: 20px; background: #f4f4f4; }
        .main-container { display: flex; gap: 20px; }
        .cart-box { width: 30%; background: white; padding: 15px; border-radius: 8px; }
        .products-box { width: 70%; display: flex; flex-wrap: wrap; gap: 15px; }
        .card { background: white; padding: 10px; border-radius: 8px; width: 200px; text-align: center; border: 1px solid #ddd; }
        .card img { width: 100px; }
        .btn-buy { background: #00b06f; color: white; border: none; padding: 8px; width: 100%; cursor: pointer; border-radius: 4px; margin-top:5px; }
    </style>
</head>
<body>
    <?php include('header.php'); ?>
    
    <div class="main-container">
        <div class="cart-box">
            <h3>🛒 Carrito</h3>
            <?php if(mysqli_num_rows($carrito) == 0): ?>
                <p>Vacío</p>
            <?php else: ?>
                <?php $total = 0; while($row = mysqli_fetch_assoc($carrito)): ?>
                    <div style="border-bottom:1px solid #eee; margin-bottom:5px;">
                        <?php echo $row['nombre']; ?> <br>
                        $<?php echo $row['precio']; ?> x <?php echo $row['cantidad']; ?>
                        <a href="?eliminar=<?php echo $row['producto_id']; ?>" style="color:red; float:right;">✖</a>
                    </div>
                    <?php $total += ($row['precio'] * $row['cantidad']); ?>
                <?php endwhile; ?>
                <h3>Total: $<?php echo $total; ?></h3>
            <?php endif; ?>
        </div>

        <div class="products-box">
            <?php while($p = mysqli_fetch_assoc($productos)): ?>
                <div class="card">
                    <img src="img/<?php echo $p['cantidad']; ?>.png" onerror="this.src='img/dinero.jpg'">
                    <h3><?php echo $p['nombre']; ?></h3>
                    <p style="color:green; font-weight:bold">$<?php echo $p['precio']; ?></p>
                    <form method="POST">
                        <input type="hidden" name="id" value="<?php echo $p['id']; ?>">
                        <button type="submit" name="agregar" class="btn-buy">COMPRAR</button>
                    </form>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>
