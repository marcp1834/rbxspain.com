cat > /var/www/rbxspain.com/conexion.php <<'EOF'
<?php
// EN DOCKER:
// Servidor: "db" (es el nombre del servicio en docker-compose)
// Usuario: "root"
// Contraseña: "root" (la que pusimos en el docker-compose)
// Base de datos: "info_clientes"

$servidor = "db";
$usuario = "root";
$password = "root";
$basedatos = "info_clientes";

// Intentamos conectar. Usamos @ para ocultar errores feos si falla
$conexion = @mysqli_connect($servidor, $usuario, $password, $basedatos);

if (!$conexion){
    // Si falla, mostramos el error técnico
    die("<h3>Error de conexión con la Base de Datos</h3><p>Docker dice: " . mysqli_connect_error() . "</p>");
}

mysqli_set_charset($conexion, "utf8");
?>
EOF