# saludDigna API

Una API construida con Laravel para la gestión de citas médicas, pacientes, direcciones y recetas. Incluye autenticación básica para proteger los endpoints y asegurar que solo usuarios autenticados puedan acceder a ciertos recursos.

---

## Tabla de Contenidos

-   [Estructura del Proyecto](#estructura-del-proyecto)
-   [Características](#características)
-   [Instalación](#instalación)
-   [Uso](#uso)
-   [Requisitos](#requisitos)
-   [Más Información](#más-información)

---

## Estructura del Proyecto

```
saludDigna-api/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/
│   │   │       ├── AuthController.php
│   │   │       ├── CitaController.php
│   │   │       ├── DireccionController.php
│   │   │       ├── PacienteController.php
│   │   │       └── RecetaController.php
│   │   ├── Middleware/
│   │   └── Kernel.php
│   ├── Models/
│   │   ├── Cita.php
│   │   ├── Direccion.php
│   │   ├── Paciente.php
│   │   ├── Receta.php
│   │   └── User.php
├── config/
├── database/
├── public/
├── routes/
│   └── api.php
├── storage/
├── tests/
├── artisan
├── composer.json
└── package.json
```

---

## Características

-   Registro, inicio y cierre de sesión de usuarios (Autenticación con Sanctum)
-   CRUD para citas, pacientes, direcciones y recetas
-   Middleware para proteger rutas y garantizar acceso solo a usuarios autenticados
-   Validaciones en las peticiones HTTP
-   Relaciones entre modelos (ejemplo: cita con paciente)
-   API RESTful con rutas limpias y organizadas

---

## Instalación

1. Clonar el repositorio:

```bash
git clone git@github.com:LSCasas/saludDigna-api.git
cd saludDigna-api
```

2. Instalar dependencias de PHP:

```bash
composer install
```

3. Copiar y configurar archivo de entorno:

```bash
cp .env.example .env
```

Configurar las variables de entorno, especialmente la conexión a la base de datos.

4. Generar clave de aplicación:

```bash
php artisan key:generate
```

5. Ejecutar migraciones para crear tablas en la base de datos:

```bash
php artisan migrate
```

6. (Opcional) Ejecutar seeders si existen para datos de prueba:

```bash
php artisan db:seed
```

7. Levantar el servidor de desarrollo:

```bash
php artisan serve
```

---

## Uso

La API se consume mediante llamadas HTTP a los endpoints definidos en `routes/api.php`. Se requiere autenticación para acceder a las rutas protegidas.

Para registrarse, usar el endpoint POST `/api/register` con:

```json
{
    "name": "Tu Nombre",
    "email": "tu.email@example.com",
    "password": "tu_contraseña"
}
```

Para iniciar sesión, usar POST `/api/login` con:

```json
{
    "email": "tu.email@example.com",
    "password": "tu_contraseña"
}
```

Una vez autenticado, se debe enviar el token de autenticación (Bearer Token) en el header `Authorization` para acceder a rutas protegidas.

---

## Requisitos

-   PHP 8.x o superior
-   Laravel 10.x
-   Composer
-   Base de datos compatible (MySQL, PostgreSQL, SQLite, etc.)
-   Laravel Sanctum para autenticación de API

---

## Más Información

-   [Documentación Laravel](https://laravel.com/docs)
-   [Laravel Sanctum](https://laravel.com/docs/sanctum)
-   [Eloquent ORM](https://laravel.com/docs/eloquent)
-   [API Resources](https://laravel.com/docs/eloquent-resources)

---
