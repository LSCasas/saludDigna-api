<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Paths habilitadas para CORS
    |--------------------------------------------------------------------------
    |
    | Aquí defines los endpoints a los que se les debe aplicar la política CORS.
    | Incluye la ruta de Sanctum para la cookie CSRF y cualquier otra API pública.
    |
    */

    'paths' => ['api/*', 'login', 'logout', 'sanctum/csrf-cookie'],

    /*
    |--------------------------------------------------------------------------
    | Métodos permitidos
    |--------------------------------------------------------------------------
    |
    | Puedes permitir todos los métodos con ['*'] o definir solo los necesarios.
    |
    */

    'allowed_methods' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Orígenes permitidos
    |--------------------------------------------------------------------------
    |
    | Aquí va el dominio del frontend. Para desarrollo con Vite (Vue o React),
    | normalmente es localhost:5173.
    |
    */

    'allowed_origins' => ['http://localhost:5173'],

    /*
    |--------------------------------------------------------------------------
    | Encabezados permitidos
    |--------------------------------------------------------------------------
    */

    'allowed_headers' => ['*'],

    /*
    |--------------------------------------------------------------------------
    | Headers expuestos al navegador
    |--------------------------------------------------------------------------
    */

    'exposed_headers' => [],

    /*
    |--------------------------------------------------------------------------
    | Tiempo en caché de la respuesta preflight (en segundos)
    |--------------------------------------------------------------------------
    */

    'max_age' => 0,

    /*
    |--------------------------------------------------------------------------
    | Permitir el envío de cookies (credenciales)
    |--------------------------------------------------------------------------
    |
    | Debe estar en true si estás usando autenticación basada en cookies con Sanctum.
    |
    */

    'supports_credentials' => true,

];
