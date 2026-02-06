<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?><div class="header">
    <div class="menu">
        <div class="logo_header">
            <img src="img/logoRBXSPAIN.jpg" alt="Logo">
        </div>
        
        <?php if(isset($_SESSION['usuario'])): ?>
            <nav class="botonescentro">
                <button class="btn" onclick="location.href='index.php'">HOME</button>
                <button class="btn" onclick="location.href='productos.php'">SHOP</button>
                <button class="btn" onclick="location.href='comentarios.php'">VALORANOS</button>
            </nav>
            
            <div class="loginyregistro">
                <button class="btn-login"><?php echo htmlspecialchars($_SESSION['usuario']); ?></button>
                <button class="btn-register" onclick="location.href='cerrar_sesion.php'">CERRAR SESIÓN</button>
            </div>

        <?php else: ?>
            <div class="loginyregistro">
                <button class="btn-login" onclick="location.href='login.php'">LOGIN</button>
                <button class="btn-register" onclick="location.href='register.php'">REGISTER</button>
            </div>
        <?php endif; ?>
    </div>
</div>