<?php

use app\modules\telegram_command\src;

return [
    'definitions' => [
        src\Executors\Commands\Close::class => src\Executors\Commands\Close::class,
        src\Executors\Commands\Hello::class => src\Executors\Commands\Hello::class,
        src\Executors\Commands\Menu::class => src\Executors\Commands\Menu::class,
        src\Executors\Commands\CopyUserMessage::class => src\Executors\Commands\CopyUserMessage::class,
    ]
];
