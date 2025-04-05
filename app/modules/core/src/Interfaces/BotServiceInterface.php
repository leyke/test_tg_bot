<?php

namespace app\modules\core\src\Interfaces;

interface BotServiceInterface
{
    public function getUpdates(int $offset = null, int $timeout = null): array;
}