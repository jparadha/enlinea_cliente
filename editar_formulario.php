<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: editar_formulario.php
Autor: Jparadha
Descripción: Formulario de edición que rescata el ID por URL, consulta
             los datos del abonado en MySQL y los auto-llena en el HTML.
===================================================================*/

session_start();
require_once 'conexion.php'; // CONEXIÓN OBLIGATORIA

// 1. CONTROL DE ACCESO (Prueba de Seguridad)
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Agente') {
    header("Location: login.php?error=" . urlencode("Acceso denegado. Se requieren permisos de Agente."));
    exit();
}

// 2. RESCATAR Y VALIDAR EL ID ENVIADO DESDE LISTAR_CLIENTES.PHP
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: listar_clientes.php?error=" . urlencode("Debe seleccionar un abonado para editar."));
    exit();
}

$id_cliente = mysqli_real_escape_string($conn, $_GET['id']);

// 3. CONSULTAR LOS DATOS EXCLUSIVOS DE ESE CLIENTE
$sql_buscar = "SELECT * FROM clientes WHERE id_cliente = '$id_cliente' LIMIT 1";
$resultado_buscar = mysqli_query($conn, $sql_buscar);

if ($resultado_buscar && mysqli_num_rows($resultado_buscar) > 0) {
    $cliente = mysqli_fetch_assoc($resultado_buscar);
} else {
    header("Location: listar_clientes.php?error=" . urlencode("El abonado solicitado no existe en el sistema."));
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Abonado - Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="formulario-container">

    <header class="header-box header-box-centrado">
        <img src="img/logo.png" alt="Logo Empresa">
        <div>
            <h1>Modificar Expediente de Abonado</h1>
            <h2>Empresa Telefónica En Línea</h2>
        </div>
    </header>

    <form action="procesar.php" method="POST">
        
        <input type="hidden" name="id_cliente" value="<?php echo $cliente['id_cliente']; ?>">

        <div class="grupo-formulario">
            <label for="usuario">Usuario Electrónico:</label>
            <input type="text" id="usuario" name="usuario" value="<?php echo htmlspecialchars($cliente['usuario']); ?>" required>
        </div>

        <div class="grupo-formulario">
            <label for="rol">Rol del Usuario:</label>
            <select id="rol" name="rol" required>
                <option value="Agente" <?php echo ($cliente['rol'] === 'Agente') ? 'selected' : ''; ?>>Agente de Atención</option>
                <option value="Cliente" <?php echo ($cliente['rol'] === 'Cliente') ? 'selected' : ''; ?>>Cliente</option>
            </select>
        </div>

        <div class="grupo-formulario">
            <label for="estado">Estado del Usuario:</label>
            <select id="estado" name="estado" required>
                <option value="Activo" <?php echo ($cliente['estado'] === 'Activo') ? 'selected' : ''; ?>>Activo</option>
                <option value="Inactivo" <?php echo ($cliente['estado'] === 'Inactivo') ? 'selected' : ''; ?>>Inactivo</option>
            </select>
        </div>

        <div class="grupo-formulario">
            <label>RUT Comercial (con DV separado):</label>
            <div class="rut-flex">
                <input type="text" name="rut" value="<?php echo htmlspecialchars($cliente['rut']); ?>" required>
                <span>-</span>
                <input type="text" name="dv" value="<?php echo htmlspecialchars($cliente['dv']); ?>" required maxlength="1">
            </div>
        </div>

        <div class="grupo-formulario">
            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($cliente['nombre']); ?>" required>
        </div>

        <div class="grupo-formulario">
            <label for="direccion">Dirección Residencial:</label>
            <input type="text" id="direccion" name="direccion" value="<?php echo htmlspecialchars($cliente['direccion']); ?>">
        </div>

        <div class="grupo-formulario">
            <label for="correo">Correo Electrónico:</label>
            <input type="email" id="correo" name="correo" value="<?php echo htmlspecialchars($cliente['correo']); ?>" required>
        </div>

        <div class="grupo-formulario">
            <label for="telefono">Teléfono de Contacto:</label>
            <input type="tel" id="telefono" name="telefono" value="<?php echo htmlspecialchars($cliente['telefono']); ?>">
        </div>

        <div class="grupo-formulario">
            <label for="plan">Tipo de Plan Contratado:</label>
            <select id="plan" name="plan" required>
                <option value="Normal" <?php echo ($cliente['plan'] === 'Normal') ? 'selected' : ''; ?>>Normal</option>
                <option value="Bueno" <?php echo ($cliente['plan'] === 'Bueno') ? 'selected' : ''; ?>>Bueno</option>
                <option value="Excelente" <?php echo ($cliente['plan'] === 'Excelente') ? 'selected' : ''; ?>>Excelente</option>
                <option value="Oferta de temporada" <?php echo ($cliente['plan'] === 'Oferta de temporada') ? 'selected' : ''; ?>>Oferta de temporada</option>
            </select>
        </div>

        <div class="grupo-formulario">
            <label for="tipo_cambio">Tipo de Solicitud de Cambio:</label>
            <select id="tipo_cambio" name="tipo_cambio" required>
                <option value="No aplica" <?php echo ($cliente['tipo_cambio'] === 'No aplica') ? 'selected' : ''; ?>>No aplica / Sin cambios</option>
                <option value="Actualización de datos personales" <?php echo ($cliente['tipo_cambio'] === 'Actualización de datos personales') ? 'selected' : ''; ?>>Actualización de datos personales</option>
                <option value="Cambio de plan" <?php echo ($cliente['tipo_cambio'] === 'Cambio de plan') ? 'selected' : ''; ?>>Cambio de plan</option>
            </select>
        </div>

        <div class="btn-container">
            <button type="submit" class="btn-guardar"> Guardar Cambios</button>
            <a href="listar_clientes.php" class="btn-cancelar"> Cancelar / Volver</a>
        </div>

    </form>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Sistema de Gestión Integrado</p>
</footer>

</body>
</html>
<?php
// Cierre limpio de la conexión al finalizar la página
mysqli_close($conn);
?>