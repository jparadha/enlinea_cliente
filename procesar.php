<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: procesar.php
Autor: Jparadha
Descripción: Procesa las operaciones CRUD de clientes (Insertar, 
             Actualizar y Eliminar) validando los roles de sesión.
===================================================================*/
session_start();
require_once 'conexion.php';

// Candado de Seguridad obligatorio para el controlador
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Agente') {
    header("Location: login.php?error=" . urlencode("Acceso denegado. Se requieren permisos de Agente."));
    exit();
}

// DETECTAR LA ACCIÓN A REALIZAR (Para el caso de eliminación vía GET)
$accion = isset($_GET['action']) ? $_GET['action'] : '';

// ==================================================================
// CASO 1: ELIMINACIÓN DE REGISTRO
// ==================================================================
if ($accion === 'eliminar') {
    if (!isset($_GET['id']) || empty($_GET['id'])) {
        header("Location: listar_clientes.php?error=" . urlencode("ID de cliente no proporcionado."));
        exit();
    }
    
    $id_cliente = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "DELETE FROM clientes WHERE id_cliente = '$id_cliente'";
    
    // Al eliminar, devolvemos al usuario a la lista para verificar que ya no está
    if (mysqli_query($conn, $sql)) {
        header("Location: listar_clientes.php?success=" . urlencode("Abonado eliminado correctamente del sistema."));
    } else {
        header("Location: listar_clientes.php?error=" . urlencode("Error al eliminar en la BD: " . mysqli_error($conn)));
    }
    exit();
}

// ==================================================================
// CASOS POST: INSERTAR O ACTUALIZAR
// ==================================================================
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Captura y sanitización de variables
    $usuario     = mysqli_real_escape_string($conn, trim($_POST['usuario']));
    $rol         = mysqli_real_escape_string($conn, $_POST['rol']);
    $estado      = mysqli_real_escape_string($conn, $_POST['estado']);
    $rut         = mysqli_real_escape_string($conn, trim($_POST['rut']));
    $dv          = mysqli_real_escape_string($conn, trim($_POST['dv']));
    $nombre      = mysqli_real_escape_string($conn, trim($_POST['nombre']));
    $direccion   = mysqli_real_escape_string($conn, trim($_POST['direccion']));
    $correo      = mysqli_real_escape_string($conn, trim($_POST['correo']));
    $telefono    = mysqli_real_escape_string($conn, trim($_POST['telefono']));
    $plan        = mysqli_real_escape_string($conn, $_POST['plan']);
    $tipo_cambio = mysqli_real_escape_string($conn, $_POST['tipo_cambio']);
    $id_cliente  = isset($_POST['id_cliente']) ? mysqli_real_escape_string($conn, $_POST['id_cliente']) : '';

    // Validación básica de campos vacíos en el servidor
    if (empty($usuario) || empty($rut) || empty($nombre) || empty($correo)) {
        header("Location: agente.php?error=" . urlencode("Error: Campos obligatorios vacíos."));
        exit();
    }

    if (!empty($id_cliente)) {
        // ACCIÓN: ACTUALIZAR CLIENTE EXISTENTE (Edición)
        $sql = "UPDATE clientes SET 
                usuario='$usuario', rol='$rol', estado='$estado', rut='$rut', dv='$dv', 
                nombre='$nombre', direccion='$direccion', correo='$correo', telefono='$telefono', 
                plan='$plan', tipo_cambio='$tipo_cambio' 
                WHERE id_cliente='$id_cliente'";
                
        $mensaje_exito = "Datos del abonado actualizados correctamente.";
        $redireccion = "listar_clientes.php"; // Volver a la lista tras editar
    } else {
        // ACCIÓN: INSERTAR NUEVO CLIENTE
        $sql = "INSERT INTO clientes (usuario, rol, estado, rut, dv, nombre, direccion, correo, telefono, plan, tipo_cambio) 
                VALUES ('$usuario', '$rol', '$estado', '$rut', '$dv', '$nombre', '$direccion', '$correo', '$telefono', '$plan', '$tipo_cambio')";
                
        $mensaje_exito = "Nuevo abonado registrado exitosamente.";
        $redireccion = "agente.php"; // Volver al panel de control tras registrar uno nuevo
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: " . $redireccion . "?success=" . urlencode($mensaje_exito));
    } else {
        header("Location: agente.php?error=" . urlencode("Fallo en la BD: " . mysqli_error($conn)));
    }
    exit();
}
?>