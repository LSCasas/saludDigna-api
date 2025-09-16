<?php

return [

    'paths' => ['/*', 'sanctum/csrf-cookie',],

    'allowed_methods' => ['*'],

    'allowed_origins' => ['http://localhost:5173', 'https://por-tu-salud.vercel.app', 'https://portusalud.lscasas.dev'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,

];
