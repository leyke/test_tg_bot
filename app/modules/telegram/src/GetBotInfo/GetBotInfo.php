<?php

namespace app\modules\telegram\src\GetBotInfo;

use app\modules\telegram\src\Services\TelegramService;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Objects\User;

class GetBotInfo implements GetBotInfoInterface
{
    private TelegramService $tgService;

    public function __construct()
    {
        $this->tgService = new TelegramService();
    }

    /**
     * @throws TelegramSDKException
     */
    public function getResponse(): User
    {
       return $this->tgService->me();
    }
}