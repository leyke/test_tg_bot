<?php

use app\modules\telegram\src;

return [
    'definitions' => [
        src\GetBotInfo\GetBotInfoInterface::class => src\GetBotInfo\GetBotInfo::class,
    ]
];
