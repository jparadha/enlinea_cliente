<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: cliente.php (Portal de Autogestión Autenticado por RUT)
Autor: Jparadha
Descripción: Módulo de lectura y actualización. Valida la existencia
             real del RUT ingresado en el login.
===================================================================*/

session_start();
require_once 'conexion.php';

// 1. CAPTURAR LOGIN INICIAL (Si viene desde el formulario de login.php)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login_rut'])) {
    $rut_ingresado = mysqli_real_escape_string($conn, trim($_POST['login_rut']));
    
    // Verificar si el cliente existe y está activo
    $sql_login = "SELECT * FROM clientes WHERE rut = '$rut_ingresado' AND estado = 'Activo' LIMIT 1";
    $resultado_login = mysqli_query($conn, $sql_login);

    if ($resultado_login && mysqli_num_rows($resultado_login) > 0) {
        // Login exitoso: Creamos la sesión para este cliente específico
        $_SESSION['usuario'] = 'Cliente_Tester';
        $_SESSION['rol'] = 'Cliente';
        $_SESSION['cliente_rut'] = $rut_ingresado; // Guardamos su RUT en la sesión
    } else {
        // Login fallido: Redirige con error
        header("Location: login.php?error=" . urlencode("El RUT ingresado no existe o se encuentra Inactivo en el sistema."));
        exit();
    }
}

// 2. CONTROL DE ACCESO GLOBAL (Por si intentan entrar directo a la URL)
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Cliente' || !isset($_SESSION['cliente_rut'])) {
    header("Location: login.php?error=" . urlencode("Acceso denegado. Requiere ingresar con un RUT válido."));
    exit();
}

// 3. RESCATAR LOS DATOS REALES DEL CLIENTE LOGUEADO
$rut_sesion = $_SESSION['cliente_rut'];
$sql_cliente = "SELECT * FROM clientes WHERE rut = '$rut_sesion' LIMIT 1";
$resultado_cliente = mysqli_query($conn, $sql_cliente);
$datos_cliente = mysqli_fetch_assoc($resultado_cliente);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal del Cliente - Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="panel" style="max-width: 750px; margin: 30px auto;">

    <img src="img/logo.png" class="logo-inicio" alt="Logo Empresa">

    <h1>Portal del Abonado</h1>
    <h2>Sucursal Virtual Telefónica</h2>
    
    <p>Bienvenido(a), <strong><?php echo htmlspecialchars($datos_cliente['nombre']); ?></strong></p>
    <p style="color: #718096; font-size: 13px; margin-bottom: 25px;">RUT Asociado: <?php echo htmlspecialchars($datos_cliente['rut']) . "-" . htmlspecialchars($datos_cliente['dv']); ?></p>

    <div class="tarjeta-plan">
        <h3>Tu Plan Contratado Actual:</h3>
        <div class="plan-nombre"> Plan <?php echo htmlspecialchars($datos_cliente['plan']); ?></div>
    </div>

    <div class="portal-cliente">
        <h3 style="text-align: left; margin-bottom: 15px; color: #2d3748;">⚙️ Solicitud de Actualización de Datos</h3>
        <p style="text-align: left; color: #4a5568; font-size: 14px; margin-bottom: 20px;">
            Modifique sus datos residenciales o de contacto si es necesario. Un agente validará los cambios en el sistema central.
        </p>

        <form action="cliente.php?success=<?php echo urlencode('Tu solicitud de actualización ha sido enviada al área técnica de forma segura.'); ?>" method="POST">
            
            <div class="grupo-formulario">
                <label>Dirección de Domicilio:</label>
                <input type="text" name="direccion" value="<?php echo htmlspecialchars($datos_cliente['direccion']); ?>" required>
            </div>

            <div class="grupo-formulario">
                <label>Correo Electrónico de Notificaciones:</label>
                <input type="email" name="correo" value="<?php echo htmlspecialchars($datos_cliente['correo']); ?>" required>
            </div>

            <div class="grupo-formulario">
                <label>Teléfono Móvil:</label>
                <input type="tel" name="telefono" value="<?php echo htmlspecialchars($datos_cliente['telefono']); ?>" required>
            </div>

            <div class="grupo-formulario">
                <label>¿Deseas solicitar un cambio de plan?</label>
                <select name="solicitud_plan">
                    <option value="No">Mantener mi plan actual</option>
                    <option value="Bueno">Solicitar Up-grade a Plan Bueno</option>
                    <option value="Excelente">Solicitar Up-grade a Plan Excelente</option>
                </select>
            </div>

            <div class="btn-container" style="margin-top: 25px;">
                <button type="submit" class="btn-guardar" style="background-color: #0275d8;">
                     Enviar Solicitud de Cambio
                </button>
            </div>
        </form>
    </div>

    <?php if (isset($_GET['success'])): ?>
        <div class="alerta-exito" style="margin-top: 20px;">
             <?php echo htmlspecialchars($_GET['success']); ?>
        </div>
    <?php endif; ?>

    <div class="acciones-salida" style="margin-top: 35px;">
        <a href="login.php" class="btn-secundario"> Cambiar de Perfil</a>
        <a href="index.php" class="btn-secundario">  Cerrar Sesión Virtual</a>
    </div>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Portal de Autogestión de Clientes</p>
</footer>

</body>
</html>
<?php mysqli_close($conn); ?>