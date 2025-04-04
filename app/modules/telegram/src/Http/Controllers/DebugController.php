<?php

namespace app\modules\telegram\src\Http\Controllers;

use app\modules\core\src\Controllers\BaseRestController;
use app\modules\telegram\src\GetBotInfo\GetBotInfoInterface;
use app\modules\telegram\src\Services\TelegramService;
use yii\web\Response;

class DebugController extends BaseRestController
{
    private TelegramService $service;

    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->service = new TelegramService();
    }

    public function actionBotInfo(GetBotInfoInterface $getBotInfo): Response
    {
        return $this->asJson(['status' => 'ok', 'data' => $getBotInfo->getResponse()]);
    }

    public function actionWebhook()
    {
        return $this->asJson($this->service->getWebhook());
    }

    public function actionGetUpdates()
    {
        return $this->asJson($this->service->getUpdates());
    }
}