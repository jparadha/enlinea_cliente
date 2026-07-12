<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: index.php 
Autor: Jparadha
Descripción: Punto de entrada del sistema. Destruye sesiones previas
             para garantizar un "Cerrar Sesión" limpio y seguro.
===================================================================*/
session_start();
session_unset();
session_destroy(); // Nos asegura que si el usuario viene de "Cerrar Sesión", su memoria quede en blanco
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresa Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="inicio">

    <img src="img/logo.png" alt="Empresa Telefónica En Línea" class="logo-inicio">

    <h1>Empresa Telefónica En Línea</h1>
    <h2>Sistema de Gestión de Clientes Abonados</h2>

    <p>
        Bienvenido al sistema de administración de clientes de la
        Empresa Telefónica En Línea.
    </p>

    <p>
        Esta aplicación permite registrar, actualizar y administrar
        la información de los clientes abonados, validando los datos
        ingresos y controlando el acceso de acuerdo con el rol del usuario.
    </p>

    <a href="login.php" class="btn-ingresar">
        Ingresar al Sistema
    </a>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Sistema de Gestión Integrado</p>
</footer>

</body>
</html>