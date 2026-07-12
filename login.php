<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: login.php
Autor: Jparadha
Descripción: Permite conmutar perfiles simulados (Agente/Cliente)
             para la validación de matrices de acceso en el taller.
===================================================================*/

session_start();

// Procesar la selección de perfil vía parámetro GET
if (isset($_GET['action'])) {
    
    if ($_GET['action'] == 'ingresar_agente') {
        $_SESSION['usuario'] = 'Agente_Tester';
        $_SESSION['rol'] = 'Agente';
        header("Location: agente.php");
        exit();
    } 
    
    if ($_GET['action'] == 'ingresar_cliente') {
        $_SESSION['usuario'] = 'Cliente_Tester';
        $_SESSION['rol'] = 'Cliente';
        header("Location: cliente.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selección de Usuario - Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="login-container">

    <img src="img/logo.png" alt="Logo Empresa Telefónica En Línea" class="logo-inicio">

    <h1>Empresa Telefónica En Línea</h1>
    <h2>Sistema de Gestión de Clientes Abonados</h2>
    <p style="color: #4a5568; margin-bottom: 30px;">Seleccione el perfil institucional con el cual desea ingresar al sistema.</p>

    <?php if (isset($_GET['error'])): ?>
        <div class="alerta-seguridad">
            <strong>[Control de Acceso]:</strong> <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

   <div class="roles">

        <div class="tarjeta">
            <h2>Agente de Atención</h2>
            <p style="color: #718096; font-size: 14px;">Acceso administrativo completo.</p>
            <ul>
                <li>Registrar nuevos clientes.</li>
                <li>Actualizar fichas de abonados.</li>
                <li>Eliminar y gestionar registros.</li>
            </ul>
            <a href="login.php?action=ingresar_agente" class="btn-ingresar">Ingresar al Panel</a>
        </div>

        <div class="tarjeta">
            <h2>Cliente Abonado</h2>
            <p style="color: #718096; font-size: 14px; margin-bottom: 15px;">Acceso limitado de autogestión por RUT.</p>
            
            <form action="cliente.php" method="POST" style="display: flex; flex-direction: column; gap: 10px; width: 100%;">
                <input type="text" 
                       name="login_rut" 
                       placeholder="Ej: 19444555 (Sin puntos ni DV)" 
                       required 
                       style="padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 14px; text-align: center;">
                <button type="submit" class="btn-ingresar" style="border: none; width: 100%; cursor: pointer;">
                    Ingresar al Portal
                </button>
            </form>
        </div>

    </div>

    <a href="index.php" class="btn-volver-portada"> Volver a la Bienvenida</a>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Sistema de Gestión Integrado</p>
</footer>

</body>
</html>