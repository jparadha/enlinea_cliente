<?php
/*===================================================================
Empresa Telefónica En Línea - Taller de Integración de Software
Archivo: registrar_cliente.php (Módulo Optimizado y Limpio)
Autor: Jparadha
Descripción: Formulario de ingreso de abonados. 
===================================================================*/

session_start();

// Blindaje de Seguridad obligatorio
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
    <title>Registrar Cliente - Telefónica En Línea</title>
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/estilos.css">
</head>

<body>

<div class="wrapper">

    <header class="header-box">
        <img src="img/logo.png" alt="Logo Telefónica En Línea">
        <div>
            <h1>Empresa Telefónica En Línea</h1>
            <h2>Registro de Clientes Usuarios</h2>
        </div>
    </header>

    <a href="agente.php" class="btn-back">← Volver al Panel Principal</a>

    <form action="procesar.php" method="POST">

        <fieldset>
            <legend>Datos de Acceso y Cuenta</legend>
            <div class="grid-3">
                <div class="form-group">
                    <label for="usuario">Nombre de Usuario</label>
                    <input type="text" id="usuario" name="usuario" minlength="8" pattern="(?=.*[A-Z])(?=.*[()$%\"!/&=]).{8,}" placeholder="Ej: JParada99!" title="Mínimo 8 caracteres, una mayúscula y un símbolo." required>
                </div>
                <div class="form-group">
                    <label for="rol">Rol Asignado</label>
                    <select id="rol" name="rol" required>
                        <option value="">Seleccione...</option>
                        <option value="Agente">Agente de Atención</option>
                        <option value="Cliente">Cliente Abonado</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="estado">Estado Inicial</label>
                    <select id="estado" name="estado" required>
                        <option value="">Seleccione...</option>
                        <option value="Activo">Activo</option>
                        <option value="Inactivo">Inactivo</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend>Información Personal del Titular</legend>
            <div class="grid-2">
                <div class="form-group">
                    <label>RUT Comercial</label>
                    <div class="rut-flex">
                        <input type="text" name="rut" maxlength="8" placeholder="12345678" required>
                        <span>-</span>
                        <input type="text" name="dv" maxlength="1" placeholder="K" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre">Nombre Completo</label>
                    <input type="text" id="nombre" name="nombre" placeholder="Nombre y Apellidos" required>
                </div>
            </div>
            
            <div class="grid-3" style="margin-top: 15px;">
                <div class="form-group" style="grid-column: span 2;">
                    <label for="direccion">Dirección Residencial</label>
                    <input type="text" id="direccion" name="direccion" placeholder="Calle, Número, Comuna" required>
                </div>
                <div class="form-group">
                    <label for="telefono">Teléfono Movil</label>
                    <input type="tel" id="telefono" name="telefono" placeholder="+56912345678" required>
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 15px;">
                <label for="correo">Correo Electrónico Corporativo</label>
                <input type="email" id="correo" name="correo" placeholder="usuario@telefonica.cl" required>
            </div>
        </fieldset>

        <fieldset>
            <legend>Especificaciones del Servicio Contratado</legend>
            <div class="grid-2">
                <div class="form-group">
                    <label for="plan">Plan Seleccionado</label>
                    <select id="plan" name="plan" required>
                        <option value="">Seleccione...</option>
                        <option value="Normal">Normal</option>
                        <option value="Bueno">Bueno</option>
                        <option value="Excelente">Excelente</option>
                        <option value="Oferta de temporada">Oferta de temporada</option>
                        <option value="No aplica">No aplica</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="tipo_cambio">Tipo de Operación Comercial</label>
                    <select id="tipo_cambio" name="tipo_cambio" required>
                        <option value="">Seleccione...</option>
                        <option value="Actualización de datos personales">Actualización de datos personales</option>
                        <option value="Cambio de plan">Cambio de plan</option>
                        <option value="No aplica">No aplica</option>
                    </select>
                </div>
            </div>
        </fieldset>

        <div class="btn-container">
            <button type="submit" class="btn-submit"> Registrar y Guardar Abonado</button>
            <button type="reset" class="btn-reset"> Limpiar Formulario</button>
        </div>

    </form>

</div>

<footer class="footer-corporativo">
    <hr>
    <p>© 2026 Empresa Telefónica En Línea | Sistema de Gestión Integrado</p>
</footer>

</body>
</html>