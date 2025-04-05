<?php

namespace app\modules\telegram\src\Http\Controllers;

use app\modules\core\src\Controllers\BaseRestController;
use app\modules\core\src\Interfaces\BotServiceInterface;
use app\modules\telegram\src\GetBotInfo\GetBotInfoInterface;
use app\modules\telegram\src\Services\TelegramService;
use Yii;
use yii\base\InvalidConfigException;
use yii\web\Response;

class DebugController extends BaseRestController
{
    private TelegramService $service;

    /**
     * @throws InvalidConfigException
     */
    public function __construct($id, $module, $config = [])
    {
        parent::__construct($id, $module, $config);

        $this->service = Yii::createObject(BotServiceInterface::class);
    }

    public function actionBotInfo(GetBotInfoInterface $getBotInfo): Response
    {
        return $this->asJson(['status' => 'ok', 'data' => $getBotInfo->getResponse()]);
    }

    public function actionWebhook(): Response
    {
        return $this->asJson($this->service->getWebhook());
    }

    public function actionWebhookDetach(): Response
    {
        return $this->asJson($this->service->detachWebhook());
    }

    public function actionUpdates(int $lastUpdateId = null): Response
    {
        return $this->asJson($this->service->getUpdates($lastUpdateId));
    }
}