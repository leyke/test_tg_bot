<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=' . env('SQL_HOST') . ';dbname=' . env('SQL_DATABASE'),
    'username' => env('SQL_USER'),
    'password' => env('SQL_PASSWORD'),
];