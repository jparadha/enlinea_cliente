<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: listar_clientes.php 
Autor: Jparadha
Descripción: Panel de búsqueda dinámica global (Agentes y Clientes).
             Muestra los registros ordenados sin desbordes ni iconos.
===================================================================*/

session_start();
require_once 'conexion.php';

// 1. CONTROL DE ACCESO (Seguridad Obligatoria)
if (!isset($_SESSION['usuario']) || $_SESSION['rol'] !== 'Agente') {
    header("Location: login.php?error=" . urlencode("Acceso denegado. Se requieren permisos de Agente."));
    exit();
}

// 2. PROCESAR LA BÚSQUEDA DINÁMICA DE TODOS LOS ROLES
$buscar = isset($_GET['buscar']) ? trim($_GET['buscar']) : '';

if (!empty($buscar)) {
    // Sanitizamos el término para evitar inyecciones SQL
    $termino = mysqli_real_escape_string($conn, $buscar);
    
    // Consulta flexible: Busca coincidencias por Nombre o RUT en TODOS los usuarios del sistema
    $sql = "SELECT id_cliente, usuario, estado, rut, dv, nombre, correo, plan, telefono, tipo_cambio, rol 
            FROM clientes 
            WHERE (nombre LIKE '%$termino%' OR rut LIKE '%$termino%') 
            ORDER BY nombre ASC";
} else {
    // Si no hay búsqueda activa, muestra los últimos 10 usuarios registrados en general
    $sql = "SELECT id_cliente, usuario, estado, rut, dv, nombre, correo, plan, telefono, tipo_cambio, rol 
            FROM clientes 
            ORDER BY id_cliente DESC LIMIT 10";
}

$resultado = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Usuarios - Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="panel panel-tabla">

    <img src="img/logo.png" class="logo-inicio" alt="Logo Telefónica En Línea">

    <h1>Consulta General de Abonados</h1>
    <h2>Módulo de Búsqueda de Clientes</h2>
    
    <p style="color: #4a5568; margin-bottom: 25px;">
        Utilice este módulo para localizar abonados registrados en la sucursal y acceder a sus expedientes de modificación técnica.
    </p>

    <div class="buscador-container">
        <form action="listar_clientes.php" method="GET" class="form-busqueda">
            <input type="text" 
                   name="buscar" 
                   class="input-busqueda" 
                   placeholder="Ingrese el Nombre completo o el RUT del abonado (sin puntos ni guion)..." 
                   value="<?php echo htmlspecialchars($buscar); ?>">
            
            <button type="submit" class="btn-buscar">Buscar Abonado</button>
            
            <?php if (!empty($buscar)): ?>
                <a href="listar_clientes.php" class="btn-limpiar">Limpiar Filtros</a>
            <?php endif; ?>
        </form>
    </div>

    <h3 style="text-align: left; color: #2d3748; font-size: 18px; margin-bottom: 15px;">
        <?php echo !empty($buscar) ? 'Resultados de la Búsqueda' : 'Últimos Usuarios Registrados'; ?>
    </h3>

    <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>
        <table class="tabla-resultados">
            <thead>
                <tr>
                    <th>RUT</th>
                    <th>Nombre del Abonado</th>
                    <th>Correo Electrónico</th>
                    <th>Teléfono</th>
                    <th>Plan Activo</th>
                    <th>Rol</th>
                    <th>Estado</th>
                    <th style="text-align: center;">Acción Administrativa</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($resultado)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['rut']) . "-" . htmlspecialchars($row['dv']); ?></td>
                        <td><strong><?php echo htmlspecialchars($row['nombre']); ?></strong></td>
                        <td><?php echo htmlspecialchars($row['correo']); ?></td>
                        <td><?php echo htmlspecialchars($row['telefono']); ?></td>
                        <td><?php echo htmlspecialchars($row['plan']); ?></td>
                        <td><strong><?php echo htmlspecialchars($row['rol']); ?></strong></td>
                        <td>
                            <span class="badge <?php echo ($row['estado'] === 'Activo') ? 'badge-activo' : 'badge-inactivo'; ?>">
                                <?php echo htmlspecialchars($row['estado']); ?>
                            </span>
                        </td>
                        <td style="text-align: center;">
                            <a href="editar_formulario.php?id=<?php echo $row['id_cliente']; ?>" class="btn-tabla-editar">
                                 Gestionar / Editar
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alerta-vacio">
             No se encontraron usuarios que coincidan con el término: "<?php echo htmlspecialchars($buscar); ?>"
        </div>
    <?php endif; ?>

    <div class="margin-top-links">
        <a href="agente.php" class="btn-secundario">Volver al Panel Principal</a>
    </div>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Sistema de Gestión Integrado</p>
</footer>

</body>
</html>