/*=========================================================
Empresa Telefónica En Línea
Taller de Integración de Software

Autor: Jparadha
Fecha: Julio 2026

Archivo: telefonica_en_linea.sql

Descripción:
Base de datos utilizada para almacenar la información de
los clientes abonados de la empresa telefónica En Línea.
=========================================================*/

CREATE DATABASE IF NOT EXISTS telefonica_en_linea;

USE telefonica_en_linea;

DROP TABLE IF EXISTS clientes;

CREATE TABLE clientes (

    id_cliente INT AUTO_INCREMENT PRIMARY KEY,

    usuario VARCHAR(50) NOT NULL,
    rol ENUM('Agente','Cliente') NOT NULL,
    estado ENUM('Activo','Inactivo') NOT NULL,

    rut INT NOT NULL UNIQUE,
    dv CHAR(1) NOT NULL,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(150) NOT NULL,
    correo VARCHAR(100) NOT NULL UNIQUE,
    telefono VARCHAR(15) NOT NULL,

    plan ENUM(
        'Normal',
        'Bueno',
        'Excelente',
        'Oferta de temporada'
        'No aplica'
    ) NOT NULL,

    tipo_cambio ENUM(
        'Actualización de datos personales',
        'Cambio de plan'
        'No aplica'
    ) NOT NULL

) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;