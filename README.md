# Empresa Telefónica En Línea

Sistema web desarrollado en PHP y MySQL para la gestión de clientes abonados de una empresa telefónica, permitiendo administrar la información de los usuarios mediante distintos perfiles de acceso y validaciones de datos.

---

## Descripción

Este proyecto fue desarrollado como actividad práctica para la asignatura **Taller de Integración de Software**.

El sistema permite administrar la información de clientes abonados mediante una aplicación web desarrollada en PHP, utilizando una base de datos MySQL para el almacenamiento de la información y TestLink para la planificación y ejecución de pruebas funcionales.

La aplicación incorpora validaciones tanto del lado del cliente como del servidor (PHP), además de restricciones implementadas en la base de datos para garantizar la integridad de la información.


## Tecnologías utilizadas

* PHP
* HTML5
* CSS3
* MySQL
* phpMyAdmin
* XAMPP
* Visual Studio Code
* Git
* GitHub
* TestLink 1.9 (Prague)

---

## Conceptos aplicados

Durante el desarrollo del proyecto se utilizaron los siguientes conceptos:

* Desarrollo Web
* Programación en PHP
* Formularios HTML
* Validaciones HTML5
* Validaciones en PHP
* Conexión a bases de datos MySQL
* Restricciones UNIQUE
* Operaciones CRUD
* Diseño de Casos de Prueba
* Gestión de pruebas con TestLink
* Control de versiones con Git y GitHub

---


## Casos de prueba implementados

El proyecto incorpora un conjunto de casos de prueba funcionales diseñados y ejecutados mediante **TestLink 1.9 (Prague)**.

Las pruebas verifican:

* Registro correcto de clientes.
* Validación de campos obligatorios.
* Validación de formato de correo electrónico.
* Validación de longitud mínima del usuario.
* Validación de letra mayúscula.
* Validación de símbolo especial.
* Restricción de correos duplicados.
* Restricción de RUT duplicados.
* Validación de permisos por rol.
* Almacenamiento correcto en MySQL.

---
## Estructura del proyecto

```
enlinea_cliente/
│
├── css/
│   └── estilos.css
│
├── img/
│   └── logo.png
│
├── db/
│   └── telefonica_en_linea.sql
│
├── agente.php
├── cliente.php
├── conexion.php
├── editar_formulario.php
├── index.php
├── listar_clientes.php
├── login.php
├── procesar.php
├── README.md
└── registrar_cliente.php

```

---

## Autor

Proyecto desarrollado para fines educativos como actividad de la asignatura **Taller de Integración de Software**, integrando desarrollo web con PHP, MySQL, pruebas funcionales mediante TestLink y control de versiones utilizando Git y GitHub.