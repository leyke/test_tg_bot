<?php

namespace app\modules\core\src\Interfaces;

interface BotServiceInterface
{
    public function getUpdates(int $offset = null, int $timeout = null): array;

    public function replyKeyboard($chatId, $keyboard): bool;

    public function sendPhoto(int $chatId, array $data): bool;
}