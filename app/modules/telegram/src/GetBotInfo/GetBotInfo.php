<?php

namespace app\modules\telegram\src\GetBotInfo;

use app\modules\telegram\src\Services\TelegramService;
use Vjik\TelegramBot\Api\FailResult;
use Vjik\TelegramBot\Api\Type\User;

class GetBotInfo implements GetBotInfoInterface
{
    private TelegramService $tgService;

    public function __construct()
    {
        $this->tgService = new TelegramService();
    }

    public function getResponse(): User|FailResult
    {
       return $this->tgService->me();
    }
}