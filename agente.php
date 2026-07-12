<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: agente.php
Autor: Jparadha
===================================================================*/

session_start();

if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Agente') {
    header("Location: login.php?error=" . urlencode("Acceso denegado. Se requieren permisos de Agente."));
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel del Agente - Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="panel">

    <img src="img/logo.png" class="logo-inicio" alt="Logo Empresa Telefónica En Línea">

    <h1>Panel del Agente</h1>
    <h2>Empresa Telefónica En Línea</h2>
    
    <p>Bienvenido al módulo de administración, <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong>.</p>

    <p style="color: #4a5568; font-size: 14px;">
        Desde este panel centralizado podrá acceder a las opciones de registro, 
        actualización y consulta de los usuarios del sistema.
    </p>

    <?php if (isset($_GET['success'])): ?>
        <div class="alerta-exito">
            [Éxito]: <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="alerta-error-panel">
            [Aviso]: <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <div class="menu-panel">

        <a href="registrar_cliente.php" class="btn-panel">
            Registrar Nuevo Usuario
        </a>

        <a href="listar_clientes.php" class="btn-panel">
            Consultar y Gestionar Registros
        </a>

    </div>

    <div class="acciones-salida">
        <a href="login.php" class="btn-secundario" style="margin-right: 12px;">
            Cambiar Usuario
        </a>

        <a href="index.php" class="btn-secundario">
            Cerrar Sesión
        </a>
    </div>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Sistema de Gestión Integrado</p>
</footer>

</body>
</html>