<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once('conexion.php');

// Variable para controlar la redirección
$redirigir = false;

// 1. Si ya estamos logueados
if (isset($_SESSION['usuario_id'])) {
    $redirigir = true;
    $destino = "productos.php";
}

$error = "";

// 2. Procesar el login
if (isset($_POST['login']) && !$redirigir) {
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $pass = $_POST['contrasena'];

    $sql = "SELECT * FROM info_clientes WHERE correo = '$correo'";
    $res = mysqli_query($conexion, $sql);

    if ($usuario = mysqli_fetch_assoc($res)) {
        if (password_verify($pass, $usuario['contrasena'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario'] = $usuario['usuario'];
            
            $redirigir = true;
            $destino = "productos.php";
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Usuario no encontrado.";
    }
}

// Si hay que redirigir, hacerlo con JavaScript
if ($redirigir) {
    echo "<script>window.location.href='$destino';</script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - RBXSpain</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body { 
            background-color: #1a1a1a; 
            color: white; 
            font-family: sans-serif; 
            display: flex; 
            flex-direction: column; 
            min-height: 100vh; 
            margin: 0; 
        }
        .login-box { 
            background: #2c2c2c; 
            padding: 40px; 
            border-radius: 10px; 
            width: 300px; 
            text-align: center; 
            border: 1px solid #444; 
            margin: 50px auto;
        }
        .login-box input { 
            width: 90%; 
            padding: 10px; 
            margin: 10px 0; 
            border-radius: 5px; 
            border: none; 
        }
        .btn-green { 
            background: #00b06f; 
            color: white; 
            padding: 10px; 
            width: 100%; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
            font-weight: bold; 
        }
        .btn-green:hover { background: #008f5a; }
        .error-msg { 
            color: #ff5555; 
            margin-bottom: 10px; 
            background: rgba(255,0,0,0.1); 
            padding: 5px; 
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <?php include('header.php'); ?>

    <div class="login-box">
        <h2>Iniciar Sesión</h2>
        
        <?php if($error): ?>
            <div class="error-msg"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="email" name="correo" placeholder="Correo electrónico" required>
            <input type="password" name="contrasena" placeholder="Contraseña" required>
            <button type="submit" name="login" class="btn-green">ENTRAR</button>
        </form>

        <p style="font-size: 0.8em; margin-top: 15px;">
            ¿No tienes cuenta? <a href="register.php" style="color: #00b06f;">Regístrate</a>
        </p>
    </div>

</body>
</html>