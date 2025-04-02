<?php

return [
    'class'    => 'yii\db\Connection',
    'dsn'      => env('DB_DSN'),
    'username' => env('DB_USERNAME'),
    'password' => env('DB_PASSWORD'),
    'charset'  => env('DB_CHARSET', 'utf8mb4'),

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
