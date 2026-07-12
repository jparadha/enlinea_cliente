<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: conexion.php
Autor: Jparadha
Descripción: Establece el enlace seguro entre la aplicación web 
             y el motor de base de datos MySQL (XAMPP).
===================================================================*/

// Parámetros de configuración del servidor local
$servidor  = "localhost";
$usuario   = "root";
$password  = "";
$basedatos = "telefonica_en_linea";

// Intentar establecer la conexión con la base de datos
$conn = mysqli_connect($servidor, $usuario, $password, $basedatos);

// Verificación obligatoria de conectividad
if (!$conn) {
    die("Error crítico de conexión a la BD: " . mysqli_connect_error());
}

// Forzar codificación UTF-8 para evitar errores de tildes y caracteres especiales
mysqli_set_charset($conn, "utf8");
?>