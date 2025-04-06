<?php

use app\modules\telegram\src;

return [
    'definitions' => [
        src\GetBotInfo\GetBotInfoInterface::class => src\GetBotInfo\GetBotInfo::class,
        src\SetWebhook\SetWebhookForTelegramInterface::class => src\SetWebhook\SetWebhookForTelegram::class,
        src\GetUpdates\GetUpdatesFromTelegramInterface::class => src\GetUpdates\GetUpdatesFromTelegram::class,
        src\ExecuteUpdates\ExecuteUpdatesFromTelegramInterface::class => src\ExecuteUpdates\ExecuteUpdatesFromTelegram::class,

        \app\modules\core\src\Interfaces\BotServiceInterface::class => src\Services\TelegramService::class,

        src\Repositories\TelegramUpdateRepositoryInterface::class => src\Repositories\TelegramUpdateRepository::class,
    ]
];
