<?php

namespace app\modules\telegram\src\SetWebhook;

use app\modules\telegram\src\Helpers\UrlHelper;
use app\modules\telegram\src\Services\TelegramService;
use Vjik\TelegramBot\Api\FailResult;
use Yii;
use yii\helpers\ArrayHelper;

class SetWebhookForTelegram implements SetWebhookForTelegramInterface
{
    private TelegramService $tgService;

    public function __construct()
    {
        $this->tgService = new TelegramService();
    }

    public function execute(): bool
    {
        $url = UrlHelper::forWebhook();
        $result = $this->tgService->setWebhook($url);

        if ($result instanceof FailResult) {
            Yii::error('setWebhook failed: ' . $result->description);

            return false;
        }
        return true;
    }
}